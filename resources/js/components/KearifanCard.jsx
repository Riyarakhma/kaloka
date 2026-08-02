import { Link } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';
import KategoriBadge from './KategoriBadge';

export default function KearifanCard({ item }) {
    return (
        <Link
            to={`/kearifan-lokal/${item.slug}`}
            className="overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg group flex h-full flex-col text-left"
            aria-label={item.judul}
        >
            <div className="aspect-[16/10] w-full overflow-hidden bg-muted">
                <img
                    src={item.foto}
                    alt={item.judul}
                    loading="lazy"
                    className="size-full object-cover transition duration-500 group-hover:scale-105"
                />
            </div>

            <div className="flex flex-1 flex-col p-6">
                <KategoriBadge
                    id={item.kategori}
                    size="sm"
                />

                <h3 className="mt-4 min-h-[64px] font-display text-[22px] leading-tight text-foreground">
                    {item.judul}
                </h3>

                <p className="mt-3 min-h-[110px] line-clamp-4 text-base leading-7 text-muted-foreground">
                    {item.cuplikan}
                </p>

                <div className="mt-auto inline-flex items-center gap-2 pt-4 font-semibold text-primary">
                    Baca selengkapnya
                    <ArrowRight className="size-5 transition group-hover:translate-x-1" />
                </div>
            </div>
        </Link>
    );
}