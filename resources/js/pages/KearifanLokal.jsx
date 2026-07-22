import { useMemo, useState } from 'react';
import {
    ArrowRight,
    Check,
    ChevronDown,
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
    const [categoryOpen, setCategoryOpen] = useState(false);

    const categoryOptions = useMemo(
        () => [
            {
                id: 'semua',
                label: 'Semua Kategori',
            },
            ...KATEGORI,
        ],
        [],
    );

    const selectedCategory =
        categoryOptions.find((kategori) => kategori.id === filter) ??
        categoryOptions[0];

    const items = useMemo(() => {
        const normalizedQuery = query.trim().toLowerCase();

        return KEARIFAN_ITEMS.filter((item) => {
            if (filter !== 'semua' && item.kategori !== filter) {
                return false;
            }

            if (!normalizedQuery) {
                return true;
            }

            const kategoriLabel =
                KATEGORI.find(
                    (kategori) => kategori.id === item.kategori,
                )?.label ?? '';

            return (
                item.judul.toLowerCase().includes(normalizedQuery) ||
                item.deskripsi.toLowerCase().includes(normalizedQuery) ||
                kategoriLabel.toLowerCase().includes(normalizedQuery)
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

                    <p className="mt-3 max-w-2xl text-lg leading-8 text-muted-foreground">
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

            <section className="container-page py-10 md:py-14">
                <div className="relative w-full max-w-md">
                    <button
                        type="button"
                        onClick={() =>
                            setCategoryOpen((previousValue) => !previousValue)
                        }
                        className={`flex w-full items-center justify-between gap-4 rounded-xl border bg-background px-4 py-3 text-left transition ${
                            categoryOpen
                                ? 'border-primary'
                                : 'border-border hover:border-primary'
                        }`}
                        aria-haspopup="listbox"
                        aria-expanded={categoryOpen}
                    >
                        <span className="truncate text-base font-medium text-foreground">
                            {selectedCategory.label}
                        </span>

                        <ChevronDown
                            className={`size-5 shrink-0 text-muted-foreground transition-transform duration-200 ${
                                categoryOpen ? 'rotate-180' : ''
                            }`}
                            strokeWidth={2}
                        />
                    </button>

                    {categoryOpen && (
                        <>
                            <button
                                type="button"
                                onClick={() => setCategoryOpen(false)}
                                className="fixed inset-0 z-30 cursor-default"
                                aria-label="Tutup pilihan kategori"
                            />

                            <div
                                className="absolute left-0 top-full z-40 mt-2 w-full overflow-hidden rounded-xl border border-border bg-background p-1 shadow-lg"
                                role="listbox"
                                aria-label="Pilihan kategori kearifan lokal"
                            >
                                {categoryOptions.map((kategori) => {
                                    const isActive =
                                        kategori.id === filter;

                                    return (
                                        <button
                                            key={kategori.id}
                                            type="button"
                                            onClick={() => {
                                                setFilter(kategori.id);
                                                setCategoryOpen(false);
                                            }}
                                            className={`flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition ${
                                                isActive
                                                    ? 'bg-primary-soft font-medium text-primary'
                                                    : 'text-foreground hover:bg-primary-soft/60'
                                            }`}
                                            role="option"
                                            aria-selected={isActive}
                                        >
                                            <span className="truncate">
                                                {kategori.label}
                                            </span>

                                            {isActive && (
                                                <Check
                                                    className="size-4 shrink-0 text-primary"
                                                    strokeWidth={2.2}
                                                />
                                            )}
                                        </button>
                                    );
                                })}
                            </div>
                        </>
                    )}
                </div>

                {items.length === 0 ? (
                    <div className="mt-12 rounded-3xl border border-dashed border-border bg-card p-10 text-center">
                        <Leaf className="mx-auto mb-4 size-12 text-primary" />

                        <h3 className="text-xl font-semibold text-foreground">
                            Kearifan lokal tidak ditemukan
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Tidak ada konten yang sesuai dengan pencarian atau
                            kategori yang dipilih.
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