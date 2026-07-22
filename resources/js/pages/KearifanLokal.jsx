import { useMemo, useState } from 'react';
import {
    ArrowRight,
    Leaf,
    Search,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

const KEARIFAN_ITEMS = [
    {
        slug: 'ekosistem-waduk-cengklik',
        judul: 'Ekosistem Waduk Cengklik',
        kategori: 'ekologi',
        deskripsi:
            'Mengenal kondisi lingkungan, sumber daya air, dan kehidupan masyarakat di sekitar Waduk Cengklik.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'menjaga-lingkungan-waduk',
        judul: 'Menjaga Lingkungan Waduk',
        kategori: 'ekologi',
        deskripsi:
            'Upaya sederhana masyarakat dalam menjaga kebersihan dan kelestarian lingkungan Waduk Cengklik.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'budidaya-padi-sobokerto',
        judul: 'Budidaya Padi di Sobokerto',
        kategori: 'pertanian',
        deskripsi:
            'Kegiatan pertanian padi yang menjadi bagian penting dari kehidupan masyarakat Desa Sobokerto.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'hasil-pertanian-warga',
        judul: 'Hasil Pertanian Warga',
        kategori: 'pertanian',
        deskripsi:
            'Beragam hasil pertanian lokal yang dibudidayakan dan dimanfaatkan oleh masyarakat Sobokerto.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'sejarah-desa-sobokerto',
        judul: 'Sejarah Desa Sobokerto',
        kategori: 'sejarah',
        deskripsi:
            'Cerita mengenai perkembangan Desa Sobokerto yang diwariskan melalui penuturan masyarakat.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'cerita-warga-tepian-waduk',
        judul: 'Cerita Warga Tepian Waduk',
        kategori: 'sejarah',
        deskripsi:
            'Kisah kehidupan warga yang tumbuh dan menjalani aktivitas sehari-hari di sekitar Waduk Cengklik.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'wisata-waduk-cengklik',
        judul: 'Wisata Waduk Cengklik',
        kategori: 'wisata',
        deskripsi:
            'Potensi wisata alam Waduk Cengklik yang dapat dikembangkan bersama masyarakat sekitar.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'peran-warga-dalam-wisata',
        judul: 'Peran Warga dalam Wisata',
        kategori: 'wisata',
        deskripsi:
            'Keterlibatan masyarakat dalam pelayanan, pengelolaan, dan pengembangan wisata desa.',
        foto: 'https://placehold.co/600x400',
    },
];

const KATEGORI = [
    {
        id: 'ekologi',
        label: 'Ekologi Waduk Cengklik',
    },
    {
        id: 'pertanian',
        label: 'Pertanian & Pangan Lokal',
    },
    {
        id: 'sejarah',
        label: 'Tradisi Lisan & Sejarah',
    },
    {
        id: 'wisata',
        label: 'Wisata Berbasis Komunitas',
    },
];

function FilterChip({ active, onClick, label }) {
    return (
        <button
            type="button"
            onClick={onClick}
            className={`rounded-full border-2 px-5 py-2.5 text-base font-semibold transition ${
                active
                    ? 'border-primary bg-primary text-primary-foreground'
                    : 'border-border bg-card text-foreground hover:border-primary hover:text-primary'
            }`}
        >
            {label}
        </button>
    );
}

function KearifanCard({ item }) {
    const kategoriLabel =
        KATEGORI.find((kategori) => kategori.id === item.kategori)?.label ??
        item.kategori;

    return (
        <article className="group overflow-hidden rounded-3xl border border-border bg-card shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
            <img
                src={item.foto}
                alt={item.judul}
                className="aspect-[3/2] w-full object-cover"
            />

            <div className="p-6">
                <span className="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary">
                    {kategoriLabel}
                </span>

                <h2 className="mt-4 font-display text-2xl leading-tight text-foreground">
                    {item.judul}
                </h2>

                <p className="mt-3 min-h-[84px] text-base leading-7 text-muted-foreground">
                    {item.deskripsi}
                </p>

                <button
                    type="button"
                    className="mt-6 inline-flex items-center gap-2 font-semibold text-primary transition group-hover:gap-3"
                >
                    Baca selengkapnya
                    <ArrowRight className="size-5" />
                </button>
            </div>
        </article>
    );
}

export default function KearifanLokal() {
    const [filter, setFilter] = useState('semua');
    const [query, setQuery] = useState('');

    const items = useMemo(() => {
        const q = query.trim().toLowerCase();

        return KEARIFAN_ITEMS.filter((item) => {
            if (filter !== 'semua' && item.kategori !== filter) {
                return false;
            }

            if (!q) {
                return true;
            }

            const kategoriLabel =
                KATEGORI.find(
                    (kategori) => kategori.id === item.kategori,
                )?.label ?? '';

            return (
                item.judul.toLowerCase().includes(q) ||
                item.deskripsi.toLowerCase().includes(q) ||
                kategoriLabel.toLowerCase().includes(q)
            );
        });
    }, [filter, query]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">
                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Leaf className="size-4" />
                        Warisan Warga Desa
                    </span>

                    <h1 className="mt-4 font-display text-4xl md:text-5xl">
                        Kearifan Lokal Sobokerto
                    </h1>

                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Jelajahi pengetahuan lokal, kehidupan masyarakat,
                        pertanian, sejarah, serta potensi lingkungan Desa
                        Sobokerto.
                    </p>

                    <form
                        className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                        onSubmit={(event) => event.preventDefault()}
                        role="search"
                    >
                        <Search className="ml-3 size-6 shrink-0 text-primary" />

                        <input
                            type="search"
                            value={query}
                            onChange={(event) =>
                                setQuery(event.target.value)
                            }
                            placeholder="Cari kearifan lokal..."
                            className="w-full bg-transparent py-3 text-lg text-foreground placeholder:text-muted-foreground focus:outline-none"
                        />
                    </form>
                </div>
            </section>

            <section className="container-page mt-10">
                <div className="flex flex-wrap gap-2">
                    <FilterChip
                        active={filter === 'semua'}
                        onClick={() => setFilter('semua')}
                        label={`Semua (${KEARIFAN_ITEMS.length})`}
                    />

                    {KATEGORI.map((kategori) => {
                        const count = KEARIFAN_ITEMS.filter(
                            (item) => item.kategori === kategori.id,
                        ).length;

                        return (
                            <FilterChip
                                key={kategori.id}
                                active={filter === kategori.id}
                                onClick={() => setFilter(kategori.id)}
                                label={`${kategori.label} (${count})`}
                            />
                        );
                    })}
                </div>

                {items.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">
                        <Leaf className="mx-auto mb-4 size-12 text-primary" />

                        <h3 className="text-xl font-semibold">
                            Kearifan lokal tidak ditemukan
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Tidak ada konten yang sesuai dengan pencarian Anda.
                        </p>
                    </div>
                ) : (
                    <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {items.map((item) => (
                            <KearifanCard
                                key={item.slug}
                                item={item}
                            />
                        ))}
                    </div>
                )}
            </section>

            <Footer />
        </div>
    );
}