import { Link } from 'react-router-dom';
import {
    Leaf,
    Mountain,
    ArrowRight,
    ShoppingBag,
    PlayCircle,
} from 'lucide-react';

import UMKMCard from '../components/UMKMCard';
import { useUmkmItems } from '../lib/umkm-api';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import KearifanCard from '../components/KearifanCard';
import { useKearifanItems } from '../lib/kearifan-api';
import { usePengaturan, ekstrakYoutubeId } from '../lib/pengaturan-api';

import heroWaduk from '../assets/waduk-cengklik-hero.jpg';
import wisataCengklik from '../assets/wisata-cengklik.jpg';

export default function Beranda() {
    const { data: kearifanItems, isLoading, isError } =
        useKearifanItems();
    const { data: pengaturan } = usePengaturan();
    const {
    data: umkmItems = [],
    isLoading: umkmLoading,
    isError: umkmError,
} = useUmkmItems();

const umkmTerbaru = Array.isArray(umkmItems)
    ? umkmItems.slice(0, 3)
    : [];
    const urlYoutube =
        pengaturan?.url_youtube || 'https://youtu.be/SAPOqu-06NI';
    const youtubeId =
        ekstrakYoutubeId(urlYoutube) || 'SAPOqu-06NI';

    const kearifanTerbaru = Array.isArray(kearifanItems)
        ? kearifanItems.slice(0, 3)
        : [];

    const scrollKeMenu = () => {
        const target = document.getElementById('menu-utama');

        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        }
    };

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            {/* ===== HERO ===== */}
            <section className="relative flex min-h-[670px] items-center overflow-hidden md:min-h-[740px]">
                <div className="absolute inset-0">
                    <img
                        src={heroWaduk}
                        alt="Pemandangan Waduk Cengklik dan pegunungan"
                        className="size-full object-cover object-center"
                        width={1600}
                        height={1000}
                    />

                    <div className="absolute inset-0 bg-gradient-to-r from-[#071c15]/88 via-[#163728]/52 to-transparent" />

                    <div className="absolute inset-0 bg-gradient-to-b from-black/10 via-transparent to-black/40" />

                    <div className="absolute -left-48 bottom-0 size-[520px] rounded-full bg-[#d6ad4a]/10 blur-3xl" />
                </div>

                <div className="container-page relative z-10 pt-28 pb-24 md:pt-36 md:pb-32">
                    <div className="max-w-5xl">
                        <div className="max-w-5xl">
                            <h1 className="font-hero max-w-4xl text-[43px] font-semibold leading-[1.03] tracking-[-0.045em] text-white drop-shadow-lg sm:text-[56px] md:text-[70px] lg:text-[76px]">
                                Merawat kearifan,
                            </h1>

                            <h2 className="font-hero mt-2 max-w-5xl text-[40px] font-bold leading-[1.03] tracking-[-0.045em] text-[#f3ddb0] drop-shadow-lg sm:text-[52px] md:text-[64px] lg:text-[70px]">
                                menyalakan literasi desa.
                            </h2>

                            <div className="mt-7 h-[3px] w-20 rounded-full bg-[#d9b85c]" />
                        </div>

                        <div className="font-body mt-8 max-w-2xl text-[15px] leading-7 text-white/85 sm:text-base md:text-[17px]">
                            <p>
                                Selamat datang di{' '}
                                <strong className="font-bold text-white">
                                    KALOKA
                                </strong>
                                , rumah digital Perpustakaan Desa Sobokerto.
                            </p>

                            <p className="mt-1">
                                Temukan buku, cerita warga, wisata, dan UMKM desa
                                dalam satu tempat.
                            </p>
                        </div>

                        <button
                            type="button"
                            onClick={scrollKeMenu}
                            className="font-body group mt-9 inline-flex items-center gap-2 border-b border-white/60 pb-1 text-sm font-semibold text-white transition duration-300 hover:border-white hover:text-[#f3ddb0] focus:outline-none sm:text-base"
                        >
                            Jelajahi KALOKA

                            <ArrowRight className="size-4 transition-transform duration-300 group-hover:translate-x-1" />
                        </button>
                    </div>
                </div>

                <div className="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-background to-transparent" />
            </section>

            {/* ===== MENU UTAMA ===== */}
            <section
                id="menu-utama"
                className="container-page relative z-10 -mt-10 scroll-mt-24"
            >
                <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    <Link
                        to="/kearifan-lokal"
                        className="card-soft group flex items-start gap-5 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div className="grid size-14 shrink-0 place-items-center rounded-2xl bg-[oklch(0.92_0.06_150)] text-primary">
                            <Leaf className="size-7 transition-transform duration-300 group-hover:scale-110" />
                        </div>

                        <div className="min-w-0">
                            <h3 className="font-display text-2xl">
                                Kearifan Lokal
                            </h3>

                            <p className="mt-1 text-base leading-relaxed text-muted-foreground">
                                Cerita, tradisi, dan pengetahuan warga desa.
                            </p>
                        </div>
                    </Link>

                    <Link
                        to="/wisata"
                        className="card-soft group flex items-start gap-5 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div className="grid size-14 shrink-0 place-items-center rounded-2xl bg-[oklch(0.94_0.07_75)] text-[oklch(0.4_0.12_60)]">
                            <Mountain className="size-7 transition-transform duration-300 group-hover:scale-110" />
                        </div>

                        <div className="min-w-0">
                            <h3 className="font-display text-2xl">
                                Info Wisata
                            </h3>

                            <p className="mt-1 text-base leading-relaxed text-muted-foreground">
                                Jelajahi keindahan Waduk Cengklik dan sekitarnya.
                            </p>
                        </div>
                    </Link>

                    <Link
                        to="/umkm"
                        className="card-soft group flex items-start gap-5 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div className="grid size-14 shrink-0 place-items-center rounded-2xl bg-[oklch(0.94_0.08_55)] text-[oklch(0.45_0.16_55)]">
                            <ShoppingBag className="size-7 transition-transform duration-300 group-hover:scale-110" />
                        </div>

                        <div className="min-w-0">
                            <h3 className="font-display text-2xl">
                                Galeri UMKM
                            </h3>

                            <p className="mt-1 text-base leading-relaxed text-muted-foreground">
                         Temukan berbagai produk, usaha, dan inovasi masyarakat Desa Sobokerto.
                            </p>
                        </div>
                    </Link>
                </div>
            </section>

            {/* ===== PROFIL DESA ===== */}
            <section className="container-page mt-28">
                <div className="grid items-center gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
                    <div className="max-w-xl">
                        <span className="inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.24em] text-primary">
                            <span className="size-2 rounded-full bg-primary" />
                            Profil Desa
                        </span>

                        <div className="mt-4 h-0.5 w-10 rounded-full bg-[oklch(0.75_0.15_80)]" />

                        <h2 className="mt-7 font-display text-4xl font-bold leading-[1.12] tracking-[-0.035em] text-foreground sm:text-5xl lg:text-[52px]">
                            Mengenal
                            <br />

                            <span className="text-primary">
                                Sobokerto
                            </span>

                            <br />
                            Lebih Dekat
                        </h2>

                        <div className="mt-6 h-0.5 w-12 rounded-full bg-primary" />

                        <p className="mt-6 max-w-lg text-base leading-8 text-muted-foreground sm:text-lg">
                            Saksikan kisah, potensi, budaya, dan kehidupan
                            masyarakat Desa Sobokerto melalui video profil desa.
                        </p>

                        <a
                          href={urlYoutube}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="btn-primary mt-8 inline-flex items-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold sm:text-base"
                        >
                            <PlayCircle className="size-5" />
                            Tonton selengkapnya
                            <ArrowRight className="size-4" />
                        </a>
                    </div>

                    <div className="w-full max-w-3xl justify-self-end">
                        <div className="overflow-hidden rounded-2xl border border-border bg-black shadow-xl">
                            <div className="aspect-video">
                                <iframe
                                    className="size-full"
                                    src={`https://www.youtube.com/embed/${youtubeId}?rel=0`}
                                    title="Video Profil Desa Sobokerto"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowFullScreen
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* ===== KEARIFAN LOKAL TERBARU ===== */}
            <section className="container-page mt-24">
                <div className="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <span className="text-sm font-semibold uppercase tracking-wide text-leaf">
                            Terbaru dari warga
                        </span>

                        <h2 className="mt-2 font-display text-3xl md:text-4xl">
                            Kearifan Lokal Desa
                        </h2>

                        <p className="mt-2 max-w-2xl text-base text-muted-foreground md:text-lg">
                            Cerita, tradisi, dan pengetahuan yang dijaga warga
                            Sobokerto dari generasi ke generasi.
                        </p>
                    </div>

                    <Link
                        to="/kearifan-lokal"
                        className="btn-outline"
                    >
                        Lihat semua
                        <ArrowRight className="size-5" />
                    </Link>
                </div>

                <div className="mt-8">
                    {isLoading ? (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {[1, 2, 3].map((item) => (
                                <div
                                    key={item}
                                    className="overflow-hidden rounded-2xl border border-border bg-card shadow-sm"
                                >
                                    <div className="h-56 animate-pulse bg-primary-soft" />

                                    <div className="space-y-4 p-5">
                                        <div className="h-5 w-40 animate-pulse rounded-full bg-primary-soft" />

                                        <div className="h-6 w-4/5 animate-pulse rounded bg-primary-soft" />

                                        <div className="h-4 w-full animate-pulse rounded bg-primary-soft" />

                                        <div className="h-4 w-3/4 animate-pulse rounded bg-primary-soft" />

                                        <div className="mt-8 h-5 w-36 animate-pulse rounded bg-primary-soft" />
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : isError ? (
                        <div className="rounded-2xl border border-red-200 bg-red-50 px-6 py-10 text-center">
                            <p className="font-display text-xl font-semibold text-red-700">
                                Data belum dapat dimuat
                            </p>

                            <p className="mt-2 text-sm leading-6 text-red-600">
                                Silakan muat ulang halaman atau periksa koneksi
                                ke layanan data Kearifan Lokal.
                            </p>
                        </div>
                    ) : kearifanTerbaru.length > 0 ? (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {kearifanTerbaru.map((item) => (
                                <KearifanCard
                                    key={item.slug}
                                    item={item}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="rounded-2xl border border-border bg-card px-6 py-12 text-center shadow-sm">
                            <p className="font-display text-xl font-semibold text-foreground">
                                Belum ada cerita yang ditampilkan
                            </p>

                            <p className="mt-2 text-sm leading-6 text-muted-foreground">
                                Konten Kearifan Lokal akan muncul setelah data
                                tersedia.
                            </p>
                        </div>
                    )}
                </div>
            </section>

            {/* ===== WISATA ===== */}
            <section className="container-page mt-24">
                <div className="grid items-center gap-10 overflow-hidden rounded-3xl border border-border bg-primary-soft md:grid-cols-2">
                    <div className="p-8 md:p-12">
                        <span className="text-sm font-semibold uppercase tracking-wide text-earth">
                            Info Wisata
                        </span>

                        <h2 className="mt-2 font-display text-3xl md:text-4xl">
                            Menyusuri Waduk Cengklik
                        </h2>

                        <p className="mt-4 text-base leading-relaxed text-foreground md:text-lg">
                            Nikmati matahari terbit di atas air, mencicipi ikan
                            bakar hasil tangkapan warga, dan berkeliling naik
                            perahu bersama pemandu setempat.
                        </p>

                        <Link
                            to="/wisata"
                            className="btn-primary mt-6"
                        >
                            Lihat wisata desa
                            <ArrowRight className="size-5" />
                        </Link>
                    </div>

                    <div className="h-64 md:h-full">
                        <img
                            src={wisataCengklik}
                            alt="Wisatawan di dermaga Waduk Cengklik"
                            loading="lazy"
                            className="size-full object-cover"
                        />
                    </div>
                </div>
            </section>
            {/* ===== UMKM TERBARU ===== */}
<section className="container-page mt-24">
    <div className="flex flex-wrap items-end justify-between gap-4">
        <div>
            <span className="text-sm font-semibold uppercase tracking-wide text-leaf">
                Produk Lokal Desa
            </span>

            <h2 className="mt-2 font-display text-3xl md:text-4xl">
                Galeri UMKM Desa
            </h2>

            <p className="mt-2 max-w-2xl text-base text-muted-foreground md:text-lg">
                Temukan berbagai produk unggulan hasil karya masyarakat
                Desa Sobokerto.
            </p>
        </div>

        <Link
            to="/umkm"
            className="btn-outline"
        >
            Lihat semua
            <ArrowRight className="size-5" />
        </Link>
    </div>

    <div className="mt-8">
        {umkmLoading ? (
            <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {[1, 2, 3].map((item) => (
                    <div
                        key={item}
                        className="overflow-hidden rounded-2xl border border-border bg-card shadow-sm"
                    >
                        <div className="h-56 animate-pulse bg-primary-soft" />

                        <div className="space-y-4 p-5">
                            <div className="h-5 w-40 animate-pulse rounded-full bg-primary-soft" />
                            <div className="h-6 w-4/5 animate-pulse rounded bg-primary-soft" />
                            <div className="h-4 w-full animate-pulse rounded bg-primary-soft" />
                            <div className="h-4 w-3/4 animate-pulse rounded bg-primary-soft" />
                            <div className="mt-8 h-5 w-36 animate-pulse rounded bg-primary-soft" />
                        </div>
                    </div>
                ))}
            </div>
        ) : umkmError ? (
            <div className="rounded-2xl border border-red-200 bg-red-50 px-6 py-10 text-center">
                <p className="font-display text-xl font-semibold text-red-700">
                    Data UMKM belum dapat dimuat
                </p>

                <p className="mt-2 text-sm leading-6 text-red-600">
                    Silakan muat ulang halaman atau periksa koneksi
                    ke layanan data UMKM.
                </p>
            </div>
        ) : umkmTerbaru.length > 0 ? (
            <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {umkmTerbaru.map((item) => (
                    <UMKMCard
                        key={item.slug}
                        item={item}
                    />
                ))}
            </div>
        ) : (
            <div className="rounded-2xl border border-border bg-card px-6 py-12 text-center shadow-sm">
                <p className="font-display text-xl font-semibold text-foreground">
                    Belum ada produk UMKM yang ditampilkan
                </p>

                <p className="mt-2 text-sm leading-6 text-muted-foreground">
                    Produk UMKM akan muncul setelah data tersedia.
                </p>
            </div>
        )}
    </div>
</section>
            <Footer />
        </div>
    );
}
