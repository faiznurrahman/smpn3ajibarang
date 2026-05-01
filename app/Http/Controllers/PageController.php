<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\ContactInfo;
use App\Models\SocialMedia;
use App\Models\PrincipalGreeting;
use App\Models\VideoProfile;
use App\Models\Extracurricular;
use App\Models\Profile;
use App\Models\OrganizationalStructure;
use App\Models\Message;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private function getSharedData(): array
    {
        return [
            'settings'    => Setting::first(),
            'contactInfo' => ContactInfo::first(),
            'socialMedia' => SocialMedia::where('is_active', true)->orderBy('order')->get(),
        ];
    }

    public function home()
{
    $data = array_merge($this->getSharedData(), [
        'greeting'   => PrincipalGreeting::first(),
        'video'      => VideoProfile::where('is_active', true)->orderBy('order')->first(),
        'teachers'   => Teacher::where('is_active', true)
                            ->where('jenis', 'guru')
                            ->orderBy('order')
                            ->take(10)
                            ->get(),
        'posts'      => Post::where('status', 'published')
                            ->where('type', 'berita')
                            ->orderBy('tanggal_publish', 'desc')
                            ->take(5)  // ← diubah
                            ->get(),
        'pengumuman' => Post::where('status', 'published')
                            ->where('type', 'pengumuman')
                            ->orderBy('is_pinned', 'desc')
                            ->orderBy('tanggal_publish', 'desc')
                            ->take(5)  // ← diubah
                            ->get(),
        'prestasi'   => Post::where('status', 'published')
                            ->where('type', 'prestasi')
                            ->orderBy('tanggal_publish', 'desc')
                            ->take(4)
                            ->get(),
    ]);

    return view('pages.home', $data);
}

    public function about()
    {
        $data = array_merge($this->getSharedData(), [
            'profile'          => Profile::first(),
            'teachers'         => Teacher::where('is_active', true)->orderBy('order')->get(),
            'extracurriculars' => Extracurricular::where('is_active', true)->orderBy('order')->get(),
            'structures'       => OrganizationalStructure::orderBy('order')->get(),
        ]);

        return view('pages.about', $data);
    }

    public function information(Request $request)
    {
        $type   = $request->query('type', 'berita');
        $search = $request->query('search');

        $query = Post::where('status', 'published')
                     ->where('type', $type);

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        $data = array_merge($this->getSharedData(), [
            'posts'  => $query->orderBy('tanggal_publish', 'desc')->paginate(9),
            'type'   => $type,
            'search' => $search,
        ]);

        return view('pages.information', $data);
    }

    public function informationDetail($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $data = array_merge($this->getSharedData(), [
            'post' => $post,
        ]);

        return view('pages.information-detail', $data);
    }

    public function gallery()
    {
        $data = array_merge($this->getSharedData(), [
            'galleries' => Gallery::with('images')->orderBy('order')->get(),
        ]);

        return view('pages.gallery', $data);
    }

    public function contact()
    {
        return view('pages.contact', $this->getSharedData());
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'subjek'        => 'nullable|string|max:255',
            'isi_pesan'     => 'required|string',
        ]);

        Message::create($request->only([
            'nama', 'email', 'nomor_telepon', 'subjek', 'isi_pesan',
        ]));

        return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!');
    }

    // Shared data untuk sidebar halaman tentang
    private function getAboutSidebar(): array
    {
        return [
            'sidebarBerita'     => Post::where('status', 'published')
                                       ->where('type', 'berita')
                                       ->orderBy('tanggal_publish', 'desc')
                                       ->take(4)
                                       ->get(),
            'sidebarPengumuman' => Post::where('status', 'published')
                                       ->where('type', 'pengumuman')
                                       ->orderBy('is_pinned', 'desc')
                                       ->orderBy('tanggal_publish', 'desc')
                                       ->take(4)
                                       ->get(),
        ];
    }

    public function sejarah()
    {
        $data = array_merge(
            $this->getSharedData(),
            $this->getAboutSidebar(),
            ['profile' => Profile::first()]
        );
        return view('pages.about.sejarah', $data);
    }

    public function visiMisi()
    {
        $data = array_merge(
            $this->getSharedData(),
            $this->getAboutSidebar(),
            ['profile' => Profile::first()]
        );
        return view('pages.about.visi-misi', $data);
    }

    public function strukturOrganisasi()
    {
        $data = array_merge(
            $this->getSharedData(),
            $this->getAboutSidebar(),
            ['structures' => OrganizationalStructure::orderBy('order')->get()]
        );
        return view('pages.about.struktur-organisasi', $data);
    }

    public function pengajar()
    {
        $data = array_merge(
            $this->getSharedData(),
            $this->getAboutSidebar(),
            [
                'guru'  => Teacher::where('is_active', true)->where('jenis', 'guru')->orderBy('order')->get(),
                'staff' => Teacher::where('is_active', true)->where('jenis', 'staff')->orderBy('order')->get(),
            ]
        );
        return view('pages.about.pengajar', $data);
    }

    public function ekstrakurikuler()
    {
        $data = array_merge(
            $this->getSharedData(),
            $this->getAboutSidebar(),
            ['extracurriculars' => Extracurricular::where('is_active', true)->orderBy('order')->get()]
        );
        return view('pages.about.ekstrakurikuler', $data);
    }
}