<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_pages_render(): void
    {
        foreach ([
            '/', '/yunuscan-zeybek-kimdir', '/hizmetler', '/hizmetler/web-tasarim-yazilim',
            '/projeler', '/projeler/manset-45-haber-portali', '/blog', '/blog?q=laravel',
            '/blog/kategori/web-yazilim', '/blog/yunuscan-zeybek-kimdir-kisa-bir-tanisma',
            '/sss', '/iletisim', '/kvkk',
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get('/hakkimda')->assertRedirect('/yunuscan-zeybek-kimdir');
        $this->get('/olmayan-sayfa')->assertNotFound();
    }

    public function test_about_page_is_optimised_for_kimdir_searches(): void
    {
        $this->get('/yunuscan-zeybek-kimdir')
            ->assertSee('<title>Yunuscan ZEYBEK Kimdir? | Yunuscan ZEYBEK</title>', false)
            ->assertSee('"@type":"Person"', false)
            ->assertSee('"@type":"ProfilePage"', false)
            ->assertSee('https://www.instagram.com/yunuscanzeybek/', false);
    }

    public function test_sitemap_and_robots(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(url('/yunuscan-zeybek-kimdir'), false)
            ->assertSee(url('/projeler/manset-45-haber-portali'), false);

        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /admin');
    }

    public function test_contact_form_stores_message_and_rejects_bots(): void
    {
        $this->post('/iletisim', [])->assertSessionHasErrors(['name', 'email', 'content', 'kvkk']);

        $this->post('/iletisim', [
            'name' => 'Ali Veli', 'email' => 'ali@example.com', 'content' => 'Merhaba', 'kvkk' => '1',
        ])->assertSessionHas('contact_success');

        $this->post('/iletisim', [
            'name' => 'Bot', 'email' => 'bot@example.com', 'content' => 'spam', 'kvkk' => '1', 'website' => 'http://spam',
        ]);

        $this->assertSame(1, Contact::count());
    }

    public function test_admin_requires_login_and_editor_cannot_open_settings(): void
    {
        $this->get('/admin')->assertRedirect('/login');

        $admin = User::first();
        foreach (['/admin', '/admin/projeler', '/admin/projeler/add', '/admin/kariyer', '/admin/ayarlar', '/admin/blog', '/admin/hizmetler'] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }

        $editor = User::create(['name' => 'Editör', 'email' => 'editor@example.com', 'password' => bcrypt('x'), 'role' => User::ROLE_EDITOR]);
        $this->actingAs($editor)->get('/admin/projeler')->assertOk();
        $this->actingAs($editor)->get('/admin/ayarlar')->assertRedirect('/admin');
    }

    public function test_admin_can_create_project_from_module_form(): void
    {
        $this->actingAs(User::first())->post('/admin/projeler/add', [
            'title' => 'Yeni Proje', 'summary' => 'Özet', 'order' => 5, 'is_featured' => '1',
        ])->assertRedirect('/admin/projeler');

        $this->get('/projeler/yeni-proje')->assertOk()->assertSee('Yeni Proje');
    }
}
