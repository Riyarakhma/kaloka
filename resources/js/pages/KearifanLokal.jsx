import { useMemo, useState } from 'react';
import { Search, Leaf } from 'lucide-react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import KearifanCard from '../components/KearifanCard';
import { useKearifanItems } from '../lib/kearifan-api';
import { KATEGORI_LIST } from '../lib/kategori';

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

export default function KearifanLokal() {
    const [filter, setFilter] = useState('semua');
    const [query, setQuery] = useState('');
    const { data: KEARIFAN_ITEMS = [], isLoading, isError } = useKearifanItems();

    const items = useMemo(() => {
        const q = query.trim().toLowerCase();
        return KEARIFAN_ITEMS.filter((it) => {
            if (filter !== 'semua' && it.kategori !== filter) return false;
            if (!q) return true;
            return (
                it.judul.toLowerCase().includes(q) ||
                it.cuplikan.toLowerCase().includes(q)
            );
        });
    }, [filter, query, KEARIFAN_ITEMS]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">
                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Leaf className="size-4" />
                        Warisan warga desa
                    </span>
                    <h1 className="mt-4 font-display text-4xl md:text-5xl">Kearifan Lokal Sobokerto</h1>
                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Kumpulan cerita, tradisi, dan pengetahuan yang hidup di tengah
                        warga — dari tepi Waduk Cengklik sampai pematang sawah.
                    </p>

                    <form
                        className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                        onSubmit={(e) => e.preventDefault()}
                        role="search"
                    >
                        <label htmlFor="cari-kearifan" className="sr-only">
                            Cari kearifan lokal
                        </label>
                        <Search className="ml-3 size-6 shrink-0 text-primary" />
                        <input
                            id="cari-kearifan"
                            type="search"
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Cari cerita, tradisi, atau nama tempat…"
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
                    {KATEGORI_LIST.map((k) => {
                        const count = KEARIFAN_ITEMS.filter((i) => i.kategori === k.id).length;
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

                {isLoading ? (
                    <div className="mt-12 text-center text-muted-foreground">Memuat data…</div>
                ) : isError ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-destructive bg-card p-10 text-center">
                        <p className="text-lg text-destructive">
                            Gagal memuat data. Pastikan server API sedang berjalan.
                        </p>
                    </div>
                ) : items.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">
                        <p className="text-lg text-muted-foreground">
                            Belum ada kearifan yang cocok dengan pencarian Anda.
                        </p>
                    </div>
                ) : (
                    <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {items.map((item) => (
                            <KearifanCard key={item.slug} item={item} />
                        ))}
                    </div>
                )}
            </section>

            <Footer />
        </div>
    );
}