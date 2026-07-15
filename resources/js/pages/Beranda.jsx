import { Link } from 'react-router-dom';
import { Search, Leaf, Mountain, ArrowRight } from 'lucide-react';
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
                        alt="Waduk Cengklik saat matahari terbit"
                        className="size-full object-cover"
                        width={1600}
                        height={1000}
                    />
                    <div className="absolute inset-0 bg-gradient-to-b from-primary/70 via-primary/55 to-primary/85" />
                </div>

                <div className="container-page relative py-20 md:py-28">
                    <div className="max-w-3xl text-primary-foreground">
                        <span className="inline-flex items-center gap-2 rounded-full bg-primary-foreground/15 px-4 py-1.5 text-sm font-semibold backdrop-blur">
                            <Leaf className="size-4" />
                            Desa Sobokerto · Boyolali · Jawa Tengah
                        </span>
                        <h1 className="mt-6 font-display text-4xl leading-tight text-primary-foreground sm:text-5xl md:text-6xl">
                            Merawat kearifan,<br />
                            menyalakan literasi desa.
                        </h1>
                        <p className="mt-5 max-w-2xl text-lg leading-relaxed text-primary-foreground/90 md:text-xl">
                            Selamat datang di <strong>KALOKA</strong>, rumah digital Perpustakaan
                            Desa Sobokerto. Temukan buku, cerita warga, dan pesona Waduk
                            Cengklik dalam satu tempat.
                        </p>

                        <form
                            className="mt-8 flex flex-col gap-3 rounded-2xl bg-background p-3 shadow-xl sm:flex-row sm:items-center"
                            onSubmit={(e) => e.preventDefault()}
                            role="search"
                        >
                            <label htmlFor="cari" className="sr-only">
                                Cari buku, kearifan, atau wisata
                            </label>
                            <div className="flex flex-1 items-center gap-3 px-3">
                                <Search className="size-6 shrink-0 text-primary" />
                                <input
                                    id="cari"
                                    type="search"
                                    placeholder="Cari buku, cerita, atau tempat wisata…"
                                    className="w-full bg-transparent py-2 text-lg text-foreground placeholder:text-muted-foreground focus:outline-none"
                                />
                            </div>
                            <button type="submit" className="btn-primary">
                                Cari
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            <section className="container-page -mt-14 relative z-10">
                <div className="grid gap-5 md:grid-cols-2">
                    <Link to="/kearifan-lokal" className="card-soft group flex items-start gap-5 p-6">
                        <div className="grid size-14 shrink-0 place-items-center rounded-2xl bg-[oklch(0.92_0.06_150)] text-primary">
                            <Leaf className="size-7" />
                        </div>
                        <div className="min-w-0">
                            <h3 className="font-display text-2xl">Kearifan Lokal</h3>
                            <p className="mt-1 text-base leading-relaxed text-muted-foreground">
                                Cerita, tradisi, dan pengetahuan warga desa.
                            </p>
                        </div>
                    </Link>

                    <Link to="/wisata" className="card-soft group flex items-start gap-5 p-6">
                        <div className="grid size-14 shrink-0 place-items-center rounded-2xl bg-[oklch(0.94_0.07_75)] text-[oklch(0.4_0.12_60)]">
                            <Mountain className="size-7" />
                        </div>
                        <div className="min-w-0">
                            <h3 className="font-display text-2xl">Info Wisata</h3>
                            <p className="mt-1 text-base leading-relaxed text-muted-foreground">
                                Jelajahi keindahan Waduk Cengklik & sekitarnya.
                            </p>
                        </div>
                    </Link>
                </div>
            </section>

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
                            Cerita, tradisi, dan pengetahuan yang dijaga warga Sobokerto dari
                            generasi ke generasi.
                        </p>
                    </div>
                    <Link to="/kearifan-lokal" className="btn-outline">
                        Lihat semua
                        <ArrowRight className="size-5" />
                    </Link>
                </div>
                <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {isLoading && <p className="text-muted-foreground">Memuat...</p>}
                    {kearifanTerbaru.map((item) => (
                        <KearifanCard key={item.slug} item={item} />
                    ))}
                </div>
            </section>

            <section className="container-page mt-24">
                <div className="grid items-center gap-10 overflow-hidden rounded-3xl border border-border bg-primary-soft md:grid-cols-2">
                    <div className="p-8 md:p-12">
                        <span className="text-sm font-semibold uppercase tracking-wide text-earth">
                            Info wisata
                        </span>
                        <h2 className="mt-2 font-display text-3xl md:text-4xl">
                            Menyusuri Waduk Cengklik
                        </h2>
                        <p className="mt-4 text-base leading-relaxed text-foreground md:text-lg">
                            Nikmati matahari terbit di atas air, mencicipi ikan bakar hasil
                            tangkapan warga, dan berkeliling naik perahu bersama pemandu
                            setempat.
                        </p>
                        <Link to="/wisata" className="btn-primary mt-6">
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

            <Footer />
        </div>
    );
}