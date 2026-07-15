import { Link } from 'react-router-dom';
import {
    Search,
    Leaf,
    Mountain,
    ArrowRight,
    Store
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import KearifanCard from '../components/KearifanCard';
import { useKearifanItems } from '../lib/kearifan-api';

import heroWaduk from '../assets/hero-waduk.jpg';
import wisataCengklik from '../assets/wisata-cengklik.jpg';

export default function Beranda() {

    const { data: kearifanItems, isLoading } = useKearifanItems();

    const kearifanTerbaru = kearifanItems?.slice(0, 3) ?? [];

    return (
        <div className="min-h-screen bg-background">

            <Navbar />

            <section className="relative overflow-hidden">

                <div className="absolute inset-0">
                    <img
                        src={heroWaduk}
                        alt="Waduk Cengklik"
                        className="size-full object-cover"
                    />

                    <div className="absolute inset-0 bg-gradient-to-b from-primary/70 via-primary/55 to-primary/85" />
                </div>

                <div className="container-page relative py-20 md:py-28">

                    <div className="max-w-3xl text-primary-foreground">

                        <span className="inline-flex items-center gap-2 rounded-full bg-primary-foreground/15 px-4 py-1.5 text-sm font-semibold backdrop-blur">

                            <Leaf className="size-4" />

                            Desa Sobokerto · Boyolali · Jawa Tengah

                        </span>

                        <h1 className="mt-6 font-display text-4xl leading-tight sm:text-5xl md:text-6xl">

                            Merawat kearifan,
                            <br />
                            menyalakan literasi desa.

                        </h1>

                        <p className="mt-5 max-w-2xl text-lg leading-relaxed">

                            Selamat datang di <strong>KALOKA</strong>,
                            rumah digital Perpustakaan Desa Sobokerto.
                            Temukan buku, cerita warga,
                            wisata,
                            dan UMKM desa dalam satu portal yang mudah.

                        </p>

                        <form
                            className="mt-8 flex flex-col gap-3 rounded-2xl bg-background p-3 shadow-xl sm:flex-row sm:items-center"
                            onSubmit={(e) => e.preventDefault()}
                        >

                            <div className="flex flex-1 items-center gap-3 px-3">

                                <Search className="size-6 shrink-0 text-primary" />

                                <input
                                    type="search"
                                    placeholder="Cari buku, cerita, wisata, atau UMKM..."
                                    className="w-full bg-transparent py-2 text-lg focus:outline-none"
                                />

                            </div>

                            <button
                                type="submit"
                                className="btn-primary"
                            >
                                Cari
                            </button>

                        </form>

                    </div>

                </div>

            </section>

            {/* ===== MENU ===== */}

            <section className="container-page -mt-14 relative z-10">

                <div className="grid gap-5 md:grid-cols-3">

                    <Link
                        to="/kearifan-lokal"
                        className="card-soft group flex items-start gap-5 p-6"
                    >

                        <div className="grid size-14 place-items-center rounded-2xl bg-[oklch(0.92_0.06_150)] text-primary">

                            <Leaf className="size-7" />

                        </div>

                        <div>

                            <h3 className="font-display text-2xl">
                                Kearifan Lokal
                            </h3>

                            <p className="mt-1 text-muted-foreground">
                                Cerita, tradisi, dan pengetahuan warga desa.
                            </p>

                        </div>

                    </Link>

                    <Link
                        to="/wisata"
                        className="card-soft group flex items-start gap-5 p-6"
                    >

                        <div className="grid size-14 place-items-center rounded-2xl bg-[oklch(0.94_0.07_75)] text-[oklch(0.4_0.12_60)]">

                            <Mountain className="size-7" />

                        </div>

                        <div>

                            <h3 className="font-display text-2xl">
                                Info Wisata
                            </h3>

                            <p className="mt-1 text-muted-foreground">
                                Jelajahi keindahan Waduk Cengklik.
                            </p>

                        </div>

                    </Link>

                    <Link
                        to="/umkm"
                        className="card-soft group flex items-start gap-5 p-6"
                    >

                        <div className="grid size-14 place-items-center rounded-2xl bg-[oklch(0.94_0.06_35)] text-[oklch(0.55_0.18_35)]">

                            <Store className="size-7" />

                        </div>

                        <div>

                            <h3 className="font-display text-2xl">
                                UMKM
                            </h3>

                            <p className="mt-1 text-muted-foreground">
                                Jelajahi produk unggulan UMKM Desa Sobokerto.
                            </p>

                        </div>

                    </Link>

                </div>

            </section>

            {/* ===== KEARIFAN ===== */}

            <section className="container-page mt-24">

                <div className="flex flex-wrap items-end justify-between gap-4">

                    <div>

                        <span className="text-sm font-semibold uppercase tracking-wide text-leaf">
                            Terbaru dari warga
                        </span>

                        <h2 className="mt-2 font-display text-3xl md:text-4xl">
                            Kearifan Lokal Desa
                        </h2>

                    </div>

                    <Link
                        to="/kearifan-lokal"
                        className="btn-outline"
                    >

                        Lihat Semua

                        <ArrowRight className="size-5" />

                    </Link>

                </div>

                <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    {isLoading && (
                        <p>Memuat...</p>
                    )}

                    {kearifanTerbaru.map((item) => (
                        <KearifanCard
                            key={item.slug}
                            item={item}
                        />
                    ))}

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

                        <p className="mt-4">

                            Nikmati panorama alam Waduk Cengklik
                            bersama keluarga.

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
                            className="size-full object-cover"
                            alt=""
                        />

                    </div>

                </div>

            </section>

            <Footer />

        </div>
    );
}