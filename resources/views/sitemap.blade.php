<?php
$categories =  \DB::table('9jb_categories')->select('url')->get();
$listings =  \DB::table('9jb_listings')->select('url','create_time','last_update_time')->orderBy('create_time','desc')->get();
$locations = \DB::table('9jb_locations')->select('url')->orderBy('name','asc')->get();
?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

    <url>
        <loc>{{ url('/') }}</loc>
    </url>

    <url>
        <loc>{{ url('search') }}</loc>
    </url>

    <url>
        <loc>{{ url('categories') }}</loc>
    </url>

    <url>
        <loc>{{ url('locations') }}</loc>
    </url>

    <url>
        <loc>{{ url('contact') }}</loc>
    </url>

    @foreach($categories as $category)
    <url>
        <loc>{{ url('categories/'.$category->url) }}</loc>
        <priority>2.0</priority>
    </url>
    @endforeach

     @foreach($listings as $listing)
    <url>
        <loc>{{ url('listing/'.$listing->url) }}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, $listing->last_update_time) }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    @endforeach

    @foreach($locations as $location)
    <url>
        <loc>{{ url('locations/'.$location->url) }}</loc>
        <priority>2.0</priority>
    </url>
    @endforeach

</urlset>