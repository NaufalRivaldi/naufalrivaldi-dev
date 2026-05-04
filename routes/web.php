<?php

use App\Models\Project;
use App\Models\Service;
use App\Settings\SeoSettings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', function () {
    $settings = app(SeoSettings::class);
    $canonical = url('/');

    SEO::setTitle($settings->default_title);
    SEO::setDescription($settings->default_description);
    SEOMeta::setCanonical($canonical);
    SEOMeta::setRobots('index, follow');

    OpenGraph::setTitle($settings->default_title);
    OpenGraph::setDescription($settings->default_description);
    OpenGraph::setUrl($canonical);
    OpenGraph::setType('website');
    if ($settings->default_og_image_url) {
        OpenGraph::addImage($settings->default_og_image_url);
    }

    TwitterCard::setType($settings->twitter_card_type);
    TwitterCard::setTitle($settings->default_title);
    TwitterCard::setDescription($settings->default_description);
    if ($settings->twitter_handle) {
        TwitterCard::addValue('site', '@'.ltrim($settings->twitter_handle, '@'));
    }
    if ($settings->default_og_image_url) {
        TwitterCard::setImage($settings->default_og_image_url);
    }

    JsonLd::setType('WebSite');
    JsonLd::setTitle($settings->site_name);
    JsonLd::addValue('url', $canonical);

    return view('welcome');
})->name('home');

Route::get('/services/{slug}', function (string $slug) {
    $service = Service::where('slug', $slug)->firstOrFail();
    $settings = app(SeoSettings::class);
    $canonical = route('service.detail', $slug);

    $title = $service->seo_title ?: ($service->title.' — '.$settings->site_name);
    $description = $service->seo_description ?: $service->subtitle;
    $ogImage = $service->seo_og_image_url ?: $settings->default_og_image_url;
    $robots = $service->seo_robots ?: 'index, follow';

    SEO::setTitle($title);
    SEO::setDescription($description);
    SEOMeta::setCanonical($canonical);
    SEOMeta::setRobots($robots);

    OpenGraph::setTitle($title);
    OpenGraph::setDescription($description);
    OpenGraph::setUrl($canonical);
    OpenGraph::setType('website');
    if ($ogImage) {
        OpenGraph::addImage($ogImage);
    }

    TwitterCard::setType($settings->twitter_card_type);
    TwitterCard::setTitle($title);
    TwitterCard::setDescription($description);
    if ($settings->twitter_handle) {
        TwitterCard::addValue('site', '@'.ltrim($settings->twitter_handle, '@'));
    }
    if ($ogImage) {
        TwitterCard::setImage($ogImage);
    }

    JsonLd::setType('Service');
    JsonLd::setTitle($service->title);
    JsonLd::setDescription($description);
    JsonLd::addValue('url', $canonical);
    JsonLd::addValue('provider', ['@type' => 'Person', 'name' => $settings->site_name]);

    return view('service-detail', ['slug' => $slug]);
})->name('service.detail');

Route::get('/projects/{slug}', function (string $slug) {
    $project = Project::with('media')->where('slug', $slug)->firstOrFail();
    $settings = app(SeoSettings::class);
    $canonical = route('project.detail', $slug);

    $title = $project->seo_title ?: ($project->title.' — '.$settings->site_name);
    $description = $project->seo_description ?: $project->subtitle;
    $ogImage = $project->seo_og_image_url
        ?: $project->getFirstMediaUrl('main_image')
        ?: $settings->default_og_image_url;
    $robots = $project->seo_robots ?: 'index, follow';

    SEO::setTitle($title);
    SEO::setDescription($description);
    SEOMeta::setCanonical($canonical);
    SEOMeta::setRobots($robots);

    OpenGraph::setTitle($title);
    OpenGraph::setDescription($description);
    OpenGraph::setUrl($canonical);
    OpenGraph::setType('website');
    if ($ogImage) {
        OpenGraph::addImage($ogImage);
    }

    TwitterCard::setType($settings->twitter_card_type);
    TwitterCard::setTitle($title);
    TwitterCard::setDescription($description);
    if ($settings->twitter_handle) {
        TwitterCard::addValue('site', '@'.ltrim($settings->twitter_handle, '@'));
    }
    if ($ogImage) {
        TwitterCard::setImage($ogImage);
    }

    JsonLd::setType('CreativeWork');
    JsonLd::setTitle($project->title);
    JsonLd::setDescription($description);
    JsonLd::addValue('url', $canonical);
    JsonLd::addValue('author', ['@type' => 'Person', 'name' => $settings->site_name]);

    return view('project-detail', ['slug' => $slug]);
})->name('project.detail');

Route::get('/robots.txt', function () {
    $settings = app(SeoSettings::class);

    return response($settings->robots_txt, 200)
        ->header('Content-Type', 'text/plain');
});

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(
            Url::create(url('/'))
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        );

    Service::orderBy('sort_order')->get()->each(function (Service $service) use ($sitemap): void {
        $sitemap->add(
            Url::create(route('service.detail', $service->slug))
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setLastModificationDate($service->updated_at)
        );
    });

    Project::orderBy('sort_order')->get()->each(function (Project $project) use ($sitemap): void {
        $sitemap->add(
            Url::create(route('project.detail', $project->slug))
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setLastModificationDate($project->updated_at)
        );
    });

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');
});
