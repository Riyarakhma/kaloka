import { useMemo, useState } from 'react';
import { Search, Store } from 'lucide-react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import UMKMCard from '../components/UMKMCard';

const UMKM_ITEMS = [
    {
        slug: 'ecoprint',
        nama: 'Batik Ecoprint Sobokerto',
        kategori: 'kerajinan',
        deskripsi: 'Produk kain ecoprint dengan motif daun alami khas Desa Sobokerto.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'stik-kangkung',
        nama: 'Stik Kangkung',
        kategori: 'kuliner',
        deskripsi: 'Olahan camilan berbahan dasar kangkung dengan cita rasa gurih.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'keripik-tulang-ikan',
        nama: 'Keripik Tulang Ikan',
        kategori: 'kuliner',
        deskripsi: 'Camilan bergizi berbahan dasar tulang ikan yang diolah menjadi keripik.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'pupuk-eceng-gondok',
        nama: 'Pupuk Organik Eceng Gondok',
        kategori: 'pertanian',
        deskripsi: 'Pupuk organik hasil pemanfaatan eceng gondok menjadi produk bernilai ekonomi.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'budidaya-lele',
        nama: 'Budidaya Lele',
        kategori: 'budidaya',
        deskripsi: 'Usaha budidaya ikan lele sebagai salah satu potensi ekonomi masyarakat.',
        foto: 'https://placehold.co/600x400',
    },
    {
        slug: 'budidaya-maggot',
        nama: 'Budidaya Maggot',
        kategori: 'budidaya',
        deskripsi: 'Budidaya maggot sebagai pakan ternak sekaligus pengolah limbah organik.',
        foto: 'https://placehold.co/600x400',
    },
];

const KATEGORI = [
    {
        id: 'kerajinan',
        label: 'Kerajinan',
    },
    {
        id: 'kuliner',
        label: 'Kuliner',
    },
    {
        id: 'pertanian',
        label: 'Pertanian',
    },
    {
        id: 'budidaya',
        label: 'Budidaya',
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

export default function UMKM() {
    const [filter, setFilter] = useState('semua');
    const [query, setQuery] = useState('');

    const items = useMemo(() => {
        const q = query.trim().toLowerCase();

        return UMKM_ITEMS.filter((item) => {
            if (filter !== 'semua' && item.kategori !== filter) return false;

            if (!q) return true;

            return (
                item.nama.toLowerCase().includes(q) ||
                item.deskripsi.toLowerCase().includes(q)
            );
        });
    }, [filter, query]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">
                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Store className="size-4" />
                        Produk Unggulan Desa
                    </span>

                    <h1 className="mt-4 font-display text-4xl md:text-5xl">
                        Galeri UMKM Sobokerto
                    </h1>

                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Jelajahi berbagai produk unggulan UMKM Desa Sobokerto mulai
                        dari kerajinan, kuliner, pertanian, hingga budidaya.
                    </p>

                    <form
                        className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                        onSubmit={(e) => e.preventDefault()}
                        role="search"
                    >
                        <Search className="ml-3 size-6 shrink-0 text-primary" />

                        <input
                            type="search"
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Cari produk UMKM..."
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
                        label={`Semua (${UMKM_ITEMS.length})`}
                    />

                    {KATEGORI.map((k) => {
                        const count = UMKM_ITEMS.filter(
                            (i) => i.kategori === k.id
                        ).length;

                        return (
                            <FilterChip
                                key={k.id}
                                active={filter === k.id}
                                onClick={() => setFilter(k.id)}
                                label={`${k.label} (${count})`}
                            />
                        );
                    })}
                </div>

                {items.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">
                        <Store className="mx-auto mb-4 size-12 text-primary" />

                        <h3 className="text-xl font-semibold">
                            Produk tidak ditemukan
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Tidak ada produk UMKM yang sesuai dengan pencarian Anda.
                        </p>
                    </div>
                ) : (
                    <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {items.map((item) => (
                            <UMKMCard key={item.slug} item={item} />
                        ))}
                    </div>
                )}
            </section>

            <Footer />
        </div>
    );
}