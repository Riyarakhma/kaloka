import { useMemo, useState } from 'react';
import { ArrowRight } from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

const categories = [
    'Semua',
    'Ekologi Waduk Cengklik',
    'Pertanian & Pangan Lokal',
    'Tradisi Lisan & Sejarah',
    'Wisata Berbasis Komunitas',
];

const kearifanItems = [
    {
        id: 1,
        slug: 'ekosistem-waduk-cengklik',
        title: 'Ekosistem Waduk Cengklik',
        category: 'Ekologi Waduk Cengklik',
        description:
            'Mengenal kondisi lingkungan, sumber daya air, dan kehidupan masyarakat di sekitar Waduk Cengklik.',
    },
    {
        id: 2,
        slug: 'menjaga-lingkungan-waduk',
        title: 'Menjaga Lingkungan Waduk',
        category: 'Ekologi Waduk Cengklik',
        description:
            'Upaya sederhana masyarakat dalam menjaga kebersihan dan kelestarian lingkungan Waduk Cengklik.',
    },
    {
        id: 3,
        slug: 'budidaya-padi-sobokerto',
        title: 'Budidaya Padi di Sobokerto',
        category: 'Pertanian & Pangan Lokal',
        description:
            'Kegiatan pertanian padi yang menjadi bagian penting dari kehidupan masyarakat Desa Sobokerto.',
    },
    {
        id: 4,
        slug: 'hasil-pertanian-warga',
        title: 'Hasil Pertanian Warga',
        category: 'Pertanian & Pangan Lokal',
        description:
            'Beragam hasil pertanian lokal yang dibudidayakan dan dimanfaatkan oleh masyarakat Sobokerto.',
    },
    {
        id: 5,
        slug: 'sejarah-desa-sobokerto',
        title: 'Sejarah Desa Sobokerto',
        category: 'Tradisi Lisan & Sejarah',
        description:
            'Cerita mengenai perkembangan Desa Sobokerto yang diwariskan melalui penuturan masyarakat.',
    },
    {
        id: 6,
        slug: 'cerita-warga-tepian-waduk',
        title: 'Cerita Warga Tepian Waduk',
        category: 'Tradisi Lisan & Sejarah',
        description:
            'Kisah kehidupan warga yang tumbuh dan menjalani aktivitas sehari-hari di sekitar Waduk Cengklik.',
    },
    {
        id: 7,
        slug: 'wisata-waduk-cengklik',
        title: 'Wisata Waduk Cengklik',
        category: 'Wisata Berbasis Komunitas',
        description:
            'Potensi wisata alam Waduk Cengklik yang dapat dikembangkan bersama masyarakat sekitar.',
    },
    {
        id: 8,
        slug: 'peran-warga-dalam-wisata',
        title: 'Peran Warga dalam Wisata',
        category: 'Wisata Berbasis Komunitas',
        description:
            'Keterlibatan masyarakat dalam pelayanan, pengelolaan, dan pengembangan wisata desa.',
    },
];

export default function KearifanLokal() {
    const [activeCategory, setActiveCategory] = useState('Semua');

    const filteredItems = useMemo(() => {
        if (activeCategory === 'Semua') {
            return kearifanItems;
        }

        return kearifanItems.filter(
            (item) => item.category === activeCategory,
        );
    }, [activeCategory]);

    const getCategoryCount = (category) => {
        if (category === 'Semua') {
            return kearifanItems.length;
        }

        return kearifanItems.filter(
            (item) => item.category === category,
        ).length;
    };

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            {/* ===== HEADER HALAMAN ===== */}
            <section className="border-b border-border bg-primary-soft">
                <div className="container-page py-16 md:py-20">
                    <span className="text-sm font-semibold uppercase tracking-[0.2em] text-primary">
                        Warisan warga desa
                    </span>

                    <h1 className="mt-3 max-w-3xl font-display text-4xl font-semibold tracking-tight text-foreground md:text-5xl">
                        Kearifan Lokal Sobokerto
                    </h1>

                    <p className="mt-5 max-w-2xl text-base leading-8 text-muted-foreground md:text-lg">
                        Jelajahi pengetahuan lokal, kehidupan masyarakat,
                        pertanian, sejarah, serta potensi lingkungan Desa
                        Sobokerto.
                    </p>
                </div>
            </section>

            {/* ===== FILTER KATEGORI ===== */}
            <section className="container-page mt-10">
                <div className="flex flex-wrap gap-3">
                    {categories.map((category) => {
                        const isActive = activeCategory === category;

                        return (
                            <button
                                key={category}
                                type="button"
                                onClick={() => setActiveCategory(category)}
                                className={`rounded-full border-2 px-5 py-3 text-sm font-semibold transition md:px-6 md:text-base ${
                                    isActive
                                        ? 'border-primary bg-primary text-primary-foreground'
                                        : 'border-border bg-background text-foreground hover:border-primary hover:text-primary'
                                }`}
                            >
                                {category} ({getCategoryCount(category)})
                            </button>
                        );
                    })}
                </div>
            </section>

            {/* ===== DAFTAR CARD ===== */}
            <section className="container-page mt-10 pb-20">
                {filteredItems.length > 0 ? (
                    <div className="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                        {filteredItems.map((item) => (
                            <article
                                key={item.id}
                                className="group overflow-hidden rounded-3xl border border-border bg-card shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                            >
                                {/* Placeholder gambar dummy */}
                                <div className="grid aspect-[3/2] place-items-center bg-muted">
                                    <span className="text-3xl font-medium text-muted-foreground/50">
                                        600 × 400
                                    </span>
                                </div>

                                <div className="p-6">
                                    <span className="inline-flex rounded-full bg-primary-soft px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary">
                                        {item.category}
                                    </span>

                                    <h2 className="mt-4 font-display text-2xl font-semibold leading-tight text-foreground">
                                        {item.title}
                                    </h2>

                                    <p className="mt-3 min-h-[84px] text-base leading-7 text-muted-foreground">
                                        {item.description}
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
                        ))}
                    </div>
                ) : (
                    <div className="rounded-3xl border border-dashed border-border p-12 text-center">
                        <h2 className="font-display text-2xl font-semibold">
                            Belum ada konten
                        </h2>

                        <p className="mt-2 text-muted-foreground">
                            Konten untuk kategori ini masih dalam proses
                            pengembangan.
                        </p>
                    </div>
                )}
            </section>

            <Footer />
        </div>
    );
}