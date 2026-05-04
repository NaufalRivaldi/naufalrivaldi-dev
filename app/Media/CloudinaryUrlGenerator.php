<?php

namespace App\Media;

use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class CloudinaryUrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {
        $diskName = $this->getDiskName();
        $diskConfig = Config::get("filesystems.disks.{$diskName}");

        if (($diskConfig['driver'] ?? null) !== 'cloudinary') {
            return parent::getUrl();
        }

        return $this->versionUrl($this->buildCloudinaryUrl($diskConfig));
    }

    /**
     * Build the correct Cloudinary delivery URL.
     *
     * The Cloudinary flysystem adapter stores files with the extension literally
     * in the public_id (e.g. 'naufal-dev/3/file.png'). The Cloudinary SDK's
     * image()->toUrl() strips '.png' thinking it's the format, producing a wrong
     * URL. We build the URL directly so the extension appears twice:
     * once in the public_id path and once as the delivery format.
     *
     * @param  array<string, mixed>  $diskConfig
     */
    private function buildCloudinaryUrl(array $diskConfig): string
    {
        $cloudName = $diskConfig['cloud_name'];
        $folder = isset($diskConfig['folder']) ? rtrim((string) $diskConfig['folder'], '/') : '';
        $secure = (bool) ($diskConfig['url']['secure'] ?? true);
        $scheme = $secure ? 'https' : 'http';

        $path = $this->getPathRelativeToRoot();
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $publicId = $folder !== '' ? "{$folder}/{$path}" : $path;

        $resourceType = $this->getCloudinaryResourceType();

        return "{$scheme}://res.cloudinary.com/{$cloudName}/{$resourceType}/upload/{$publicId}.{$ext}";
    }

    private function getCloudinaryResourceType(): string
    {
        $mimeType = (string) ($this->media->mime_type ?? '');

        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        return 'raw';
    }
}
