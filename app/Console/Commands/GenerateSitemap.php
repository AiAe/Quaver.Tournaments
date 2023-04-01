<?php

namespace App\Console\Commands;

use App\Models\Tournament;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';

    protected $description = "Generates sitemap";

    public function __construct()
    {
        parent::__construct();
    }

    private $page = 1;
    private $sitemap = null;

    public function handle()
    {
        $this->sitemap = SitemapIndex::create();
        $this->sitemap->add('sitemaps/sitemap_general.xml');

        $sitemap_general = Sitemap::create();
        $sitemap_general->add(Url::create(route('web.home'))->setPriority(1));
        $sitemap_general->add(Url::create(route('web.tournaments.index'))->setPriority(1));

        $sitemap_general->writeToFile(public_path('sitemaps/sitemap_general.xml'));

        Tournament::query()->select(['slug'])->without(['metas'])->chunk(5000, function ($tournaments) {
            $sitemap_tournaments = Sitemap::create();

            $this->sitemap->add(sprintf('sitemaps/tournaments/sitemap_tournaments_%s.xml', $this->page));

            foreach ($tournaments as $tournament) {
                $sitemap_tournaments->add(route('web.tournaments.show', $tournament));
            }

            $sitemap_tournaments->writeToFile(public_path(sprintf('sitemaps/tournaments/sitemap_tournaments_%s.xml', $this->page)));

            $this->page += 1;
        });

        $this->sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Done');
    }
}
