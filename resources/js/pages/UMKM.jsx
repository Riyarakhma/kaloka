import { useMemo, useState } from 'react';
import { Search, Store } from 'lucide-react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

const UMKM_ITEMS = [];

const KATEGORI = [
    {
        id: 'ecoprint',
        label: 'Ecoprint',
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
        const q = query.toLowerCase();

        return UMKM_ITEMS.filter((item) => {
            if (filter !== 'semua' && item.kategori !== filter) return false;

            if (!q) return true;

            return item.nama.toLowerCase().includes(q);
        });
    }, [filter, query]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">

                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Store className="size-4" />
                        Produk UMKM Desa
                    </span>

                    <h1 className="mt-4 font-display text-4xl md:text-5xl">
                        UMKM Desa Sobokerto
                    </h1>

                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Jelajahi berbagai produk unggulan UMKM Desa Sobokerto.
                        Saat ini kategori yang tersedia adalah Ecoprint.
                    </p>

                    <form
                        className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                        onSubmit={(e) => e.preventDefault()}
                    >
                        <Search className="ml-3 size-6 shrink-0 text-primary" />

                        <input
                            type="search"
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Cari produk UMKM..."
                            className="w-full bg-transparent py-3 text-lg focus:outline-none"
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

                    {KATEGORI.map((k) => (
                        <FilterChip
                            key={k.id}
                            active={filter === k.id}
                            onClick={() => setFilter(k.id)}
                            label={`${k.label} (${UMKM_ITEMS.filter(i => i.kategori === k.id).length})`}
                        />
                    ))}

                </div>

                {items.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">

                        <Store className="mx-auto mb-4 size-12 text-primary" />

                        <h3 className="text-xl font-semibold">
                            Produk UMKM belum tersedia
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Data UMKM masih dalam proses pendataan dan survei.
                            Nantinya produk Ecoprint serta UMKM lainnya akan
                            ditampilkan di halaman ini.
                        </p>

                    </div>
                ) : (
                    <div className="grid gap-6 mt-8">
                        {/* nanti isi card UMKM */}
                    </div>
                )}

            </section>

            <Footer />
        </div>
    );
}