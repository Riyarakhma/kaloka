import { Link } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';
import KategoriBadge from './KategoriBadge';

export default function KearifanCard({ item }) {
    return (
        <Link
            to="/kearifan-lokal"
            className="card-soft group flex h-full flex-col text-left"
            aria-label={item.judul}
        >
            <div className="aspect-[4/3] w-full overflow-hidden bg-muted">
                <img
                    src={item.foto}
                    alt={item.judul}
                    loading="lazy"
                    className="size-full object-cover transition duration-500 group-hover:scale-105"
                />
            </div>
            <div className="flex flex-1 flex-col gap-3 p-5">
                <KategoriBadge id={item.kategori} size="sm" />
                <h3 className="font-display text-xl leading-tight text-foreground">
                    {item.judul}
                </h3>
                <p className="text-base leading-relaxed text-muted-foreground">
                    {item.cuplikan}
                </p>
                <div className="mt-auto flex items-center gap-2 pt-2 text-base font-semibold text-primary">
                    Baca selengkapnya
                    <ArrowRight className="size-5 transition group-hover:translate-x-1" />
                </div>
            </div>
        </Link>
    );
}