import { useRef, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import {
    ArrowLeft,
    ChevronLeft,
    ChevronRight,
    Clock,
    ExternalLink,
    Globe,
    MapPin,
    Phone,
    Store,
    Tag,
    User,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

import { useQuery } from '@tanstack/react-query';

export default function DetailUMKM() {
    const { slug } = useParams();

    const { data: umkm, isLoading } = useQuery({
        queryKey: ['umkm', slug],
        queryFn: async () => {
            const res = await fetch(`/api/umkm/${slug}`);

            if (!res.ok) return null;

            const json = await res.json();
            const item = json.data;

            let produk = item.produk;
            if (typeof produk === 'string') {
                try {
                    produk = JSON.parse(produk);
                } catch {
                    produk = [];
                }
            }
            if (!Array.isArray(produk)) {
                produk = [];
            }

            let jamOperasional = item.jam_operasional;
            if (Array.isArray(jamOperasional)) {
                jamOperasional = jamOperasional
                    .map((j) =>
                        j && typeof j === 'object'
                            ? [j.hari, j.jam].filter(Boolean).join(': ')
                            : String(j ?? ''),
                    )
                    .filter(Boolean)
                    .join('\n') || null;
            } else if (jamOperasional && typeof jamOperasional === 'object') {
                jamOperasional = [jamOperasional.hari, jamOperasional.jam]
                    .filter(Boolean)
                    .join(': ') || null;
            }

            const fotoList = Array.isArray(item.foto)
                ? item.foto.filter(Boolean).map((path) => `/storage/${path}`)
                : [];

            return {
                ...item,
                produk,
                jam_operasional: jamOperasional,
                foto: fotoList,
            };
        },
    });

    if (isLoading) {
        return (
            <div className="min-h-screen bg-background">
                <Navbar />

                <main className="container-page py-24 text-center text-muted-foreground">
                    Memuat...
                </main>

                <Footer />
            </div>
        );
    }

    if (!umkm) {
        return (
            <div className="min-h-screen bg-background">
                <Navbar />

                <main className="container-page py-24 text-center">
                    <Store className="mx-auto size-14 text-primary" />

                    <h1 className="mt-5 font-display text-4xl text-foreground">
                        UMKM tidak ditemukan
                    </h1>

                    <p className="mt-3 text-muted-foreground">
                        Data UMKM yang kamu cari belum tersedia.
                    </p>

                    <Link
                        to="/umkm"
                        className="mt-8 inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 font-semibold text-white"
                    >
                        <ArrowLeft className="size-5" />
                        Kembali
                    </Link>
                </main>

                <Footer />
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <main className="container-page py-10 md:py-14">
                <Link
                    to="/umkm"
                    className="inline-flex items-center gap-2 font-semibold text-primary transition hover:gap-3"
                >
                    <ArrowLeft className="size-5" />
                    Kembali ke Galeri UMKM
                </Link>

                <div className="mt-8">
                    <article className="overflow-hidden rounded-3xl border border-border bg-card shadow-sm">

                        <FotoCarousel foto={umkm.foto} nama={umkm.nama_umkm} />

                        <div className="p-6 md:p-9">

                            <span className="inline-flex rounded-full bg-primary/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-wide text-primary">
                                {umkm.kategori}
                            </span>

                            <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                {umkm.nama_umkm}
                            </h1>

                            <div className="mt-5 flex items-start gap-2 text-muted-foreground">
                                <MapPin className="mt-0.5 size-5 shrink-0 text-primary" />

                                <p className="leading-7">
                                    {umkm.alamat}
                                </p>
                            </div>

                            <section className="mt-9">
                                <h2 className="text-lg font-bold text-foreground">
                                    Tentang Usaha
                                </h2>

                                <div className="mt-4 space-y-5">
                                    <p className="text-base leading-8 text-foreground/80 md:text-lg whitespace-pre-line">
                                        {umkm.deskripsi}
                                    </p>
                                </div>
                            </section>

                            <section className="mt-9 border-t border-border pt-8">
                                <h2 className="text-lg font-bold text-foreground">
                                    Produk
                                </h2>

                                <div className="mt-5 space-y-4">

                                    {(umkm.produk ?? []).length > 0 ? (
                                        umkm.produk.map((produk, index) => (
                                            <div
                                                key={index}
                                                className="rounded-2xl border border-border bg-background p-5"
                                            >
                                                <div className="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                                    <div className="min-w-0">
                                                        <h3 className="font-semibold text-lg text-foreground">
                                                            {produk.nama}
                                                        </h3>

                                                        {produk.deskripsi ? (
                                                            <p className="mt-2 text-muted-foreground leading-7">
                                                                {produk.deskripsi}
                                                            </p>
                                                        ) : null}
                                                    </div>

                                                    {produk.harga ? (
                                                        <div className="shrink-0">
                                                            <span className="inline-flex rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                                                                {new Intl.NumberFormat('id-ID', {
                                                                    style: 'currency',
                                                                    currency: 'IDR',
                                                                    maximumFractionDigits: 0,
                                                                }).format(produk.harga)}
                                                            </span>
                                                        </div>
                                                    ) : null}
                                                </div>
                                            </div>
                                        ))
                                    ) : (
                                        <div className="rounded-2xl border border-dashed border-border p-5 text-muted-foreground">
                                            Belum ada data produk.
                                        </div>
                                    )}

                                </div>
                            </section>

                            <section className="mt-9 border-t border-border pt-8">
                                <h2 className="text-lg font-bold text-foreground">
                                    Informasi UMKM
                                </h2>

                                <div className="mt-6 space-y-6">

                                    <InfoItem
                                        icon={User}
                                        title="Pemilik Usaha"
                                    >
                                        {umkm.pemilik ?? '-'}
                                    </InfoItem>

                                    <InfoItem
                                        icon={MapPin}
                                        title="Alamat UMKM"
                                    >
                                        {umkm.alamat ?? '-'}
                                    </InfoItem>

                                    {umkm.link_maps ? (
                                        <div className="flex items-start gap-4 rounded-2xl border border-border bg-background p-5">
                                            <div className="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                                <ExternalLink className="size-5" />
                                            </div>

                                            <div className="min-w-0">
                                                <h3 className="font-semibold text-foreground">
                                                    Google Maps
                                                </h3>

                                                <a
                                                    href={umkm.link_maps}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="mt-2 inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:underline"
                                                >
                                                    Lihat lokasi di Google Maps
                                                    <ExternalLink className="size-3.5" />
                                                </a>
                                            </div>
                                        </div>
                                    ) : (
                                        <InfoItem
                                            icon={ExternalLink}
                                            title="Google Maps"
                                        >
                                            -
                                        </InfoItem>
                                    )}

                                    <InfoItem
                                        icon={Clock}
                                        title="Operasional"
                                    >
                                        {umkm.jam_operasional ?? '-'}
                                    </InfoItem>

                                    <InfoItem
                                        icon={Phone}
                                        title="Kontak"
                                    >
                                        {umkm.kontak ?? '-'}
                                    </InfoItem>

                                    <InfoItem
                                        icon={Globe}
                                        title="Sosial Media"
                                    >
                                        {umkm.sosial_media ?? '-'}
                                    </InfoItem>

                                </div>
                            </section>
                        </div>
                    </article>
                </div>
            </main>

            <Footer />
        </div>
    );
}

function FotoCarousel({ foto, nama }) {
    const scrollerRef = useRef(null);
    const [index, setIndex] = useState(0);

    if (!foto || foto.length === 0) {
        return (
            <figure className="aspect-[16/9] overflow-hidden bg-muted">
                <div className="flex h-full items-center justify-center">
                    <Store className="size-16 text-primary/40" />
                </div>
            </figure>
        );
    }

    const goTo = (i) => {
        const el = scrollerRef.current;
        if (!el) return;
        const clamped = Math.max(0, Math.min(i, foto.length - 1));
        el.scrollTo({ left: clamped * el.clientWidth, behavior: 'smooth' });
    };

    const handleScroll = () => {
        const el = scrollerRef.current;
        if (!el || el.clientWidth === 0) return;
        setIndex(Math.round(el.scrollLeft / el.clientWidth));
    };

    return (
        <figure className="relative aspect-[16/9] overflow-hidden bg-muted">
            <div
                ref={scrollerRef}
                onScroll={handleScroll}
                className="flex h-full w-full snap-x snap-mandatory overflow-x-auto scroll-smooth"
            >
                {foto.map((src, i) => (
                    <img
                        key={i}
                        src={src}
                        alt={`${nama} - foto ${i + 1}`}
                        className="h-full w-full shrink-0 snap-center object-cover"
                    />
                ))}
            </div>

            {foto.length > 1 && (
                <>
                    <button
                        type="button"
                        onClick={() => goTo(index - 1)}
                        disabled={index === 0}
                        className="absolute left-3 top-1/2 flex size-9 -translate-y-1/2 items-center justify-center rounded-full bg-black/40 text-white backdrop-blur transition hover:bg-black/60 disabled:opacity-0"
                        aria-label="Foto sebelumnya"
                    >
                        <ChevronLeft className="size-5" />
                    </button>

                    <button
                        type="button"
                        onClick={() => goTo(index + 1)}
                        disabled={index === foto.length - 1}
                        className="absolute right-3 top-1/2 flex size-9 -translate-y-1/2 items-center justify-center rounded-full bg-black/40 text-white backdrop-blur transition hover:bg-black/60 disabled:opacity-0"
                        aria-label="Foto berikutnya"
                    >
                        <ChevronRight className="size-5" />
                    </button>

                    <div className="absolute bottom-3 left-1/2 flex -translate-x-1/2 gap-1.5">
                        {foto.map((_, i) => (
                            <button
                                key={i}
                                type="button"
                                onClick={() => goTo(i)}
                                aria-label={`Ke foto ${i + 1}`}
                                className={
                                    i === index
                                        ? 'h-1.5 w-4 rounded-full bg-white transition-all'
                                        : 'h-1.5 w-1.5 rounded-full bg-white/60 transition-all'
                                }
                            />
                        ))}
                    </div>

                    <div className="absolute right-3 top-3 rounded-full bg-black/40 px-2.5 py-1 text-xs font-medium text-white backdrop-blur">
                        {index + 1}/{foto.length}
                    </div>
                </>
            )}
        </figure>
    );
}

function InfoItem({
    icon: Icon,
    title,
    children,
}) {
    const raw =
        children === null ||
        children === undefined ||
        children === ''
            ? '-'
            : children;

    const value =
        typeof raw === 'object' && raw !== null
            ? '-'
            : raw;

    const isLink =
        typeof value === 'string' &&
        (value.startsWith('http://') ||
            value.startsWith('https://'));

    return (
        <div className="flex items-start gap-4 rounded-2xl border border-border bg-background p-5">
            <div className="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <Icon className="size-5" />
            </div>

            <div className="min-w-0">
                <h3 className="font-semibold text-foreground">
                    {title}
                </h3>

                <div className="mt-2 text-sm leading-7 text-muted-foreground break-words whitespace-pre-line">
                    {isLink ? (
                        <a
                            href={value}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="font-medium text-primary hover:underline"
                        >
                            {value}
                        </a>
                    ) : (
                        value
                    )}
                </div>
            </div>
        </div>
    );
}