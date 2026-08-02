import { Link, useParams } from 'react-router-dom';
import {
    ArrowLeft,
    FileText,
    MapPin,
    UserRound,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

import { KATEGORI_KEARIFAN } from '../data/kearifanData';
import { useKearifanDetail } from '../lib/kearifan-api';

function valueOrDash(value) {
    if (value === null || value === undefined) {
        return '-';
    }

    if (Array.isArray(value)) {
        return value.length > 0 ? value.join(', ') : '-';
    }

    if (typeof value === 'string') {
        return value.trim() !== '' ? value : '-';
    }

    return String(value);
}

function InfoCard({ icon: Icon, title, children }) {
    return (
        <section className="rounded-2xl border border-border bg-card p-5 shadow-sm">
            <div className="flex items-start gap-4">
                <div className="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <Icon className="size-5" />
                </div>
                <div className="min-w-0">
                    <h2 className="font-semibold text-foreground">{title}</h2>
                    <div className="mt-2 text-sm leading-6 text-muted-foreground">
                        {children}
                    </div>
                </div>
            </div>
        </section>
    );
}

function NotFound() {
    return (
        <div className="min-h-screen bg-background">
            <Navbar />
            <main className="container-page py-24 text-center">
                <FileText className="mx-auto size-14 text-primary" />
                <h1 className="mt-5 font-display text-4xl text-foreground">
                    Artikel tidak ditemukan
                </h1>
                <p className="mt-3 text-muted-foreground">
                    Artikel yang kamu cari belum tersedia.
                </p>
                <Link
                    to="/kearifan-lokal"
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

export default function DetailKearifan() {
    const { slug } = useParams();
    const { data: artikel, isLoading, isError } = useKearifanDetail(slug);

    if (isLoading) {
        return (
            <div className="min-h-screen bg-background">
                <Navbar />
                <main className="container-page py-24 text-center text-muted-foreground">
                    Memuat artikel...
                </main>
                <Footer />
            </div>
        );
    }

    if (isError || !artikel) {
        return <NotFound />;
    }

    const dimensiLabel =
        KATEGORI_KEARIFAN.find((kategori) => kategori.id === artikel.kategori)
            ?.label ?? artikel.kategori;

    return (
        <div className="min-h-screen bg-background">
            <Navbar />
            <main className="container-page py-10 md:py-14">
                <Link
                    to="/kearifan-lokal"
                    className="inline-flex items-center gap-2 font-semibold text-primary transition hover:gap-3"
                >
                    <ArrowLeft className="size-5" />
                    Kembali ke Kearifan Lokal
                </Link>

                <div className="mt-8">
                    <article className="overflow-hidden rounded-3xl border border-border bg-card shadow-sm">
                        <figure className="aspect-video overflow-hidden bg-muted">
                            <img
                                src={artikel.foto}
                                alt={artikel.judul}
                                className="h-full w-full object-cover"
                            />
                        </figure>

                        <div className="p-6 md:p-9">
                            <span className="inline-flex rounded-full bg-primary-soft px-3 py-1.5 text-sm font-semibold text-primary">
                                {dimensiLabel}
                            </span>

                            <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                {artikel.judul}
                            </h1>

                            <div className="mt-5 flex items-center gap-2 text-muted-foreground">
                                <MapPin className="size-5 shrink-0 text-primary" />
                                <p className="text-base leading-7 md:text-lg">
                                    {valueOrDash(artikel.lokasi)}
                                </p>
                            </div>
                            <section className="mt-9">
                                <h2 className="text-lg font-bold text-foreground">
                                    Deskripsi
                                </h2>
                                <div className="mt-4 space-y-5">
                                    {String(artikel.deskripsi ?? '-')
                                        .split('\n')
                                        .filter(Boolean)
                                        .map((paragraf, index) => (
                                            <p
                                                key={`${artikel.slug}-${index}`}
                                                className="text-base leading-8 text-foreground/80 md:text-lg"
                                            >
                                                {paragraf}
                                            </p>
                                        ))}
                                </div>
                            </section>

                            {artikel.kataKunci.length > 0 && (
                                <section className="mt-9 border-t border-border pt-8">
                                    <h2 className="text-lg font-bold text-foreground">
                                        Kata Kunci
                                    </h2>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        {artikel.kataKunci.map((kata) => (
                                            <span
                                                key={kata}
                                                className="rounded-full bg-primary-soft px-4 py-2 text-sm font-medium text-primary"
                                            >
                                                {kata}
                                            </span>
                                        ))}
                                    </div>
                                </section>
                            )}

                            <section className="mt-9 border-t border-border pt-8">
                                <h2 className="text-lg font-bold text-foreground">
                                    Informasi Kearifan Lokal
                                </h2>
                                <div className="mt-5 space-y-4">
                                    <InfoCard
                                        icon={UserRound}
                                        title="Narasumber"
                                    >
                                        {valueOrDash(artikel.narasumber)}
                                    </InfoCard>
                                    <InfoCard
                                        icon={MapPin}
                                        title="Lokasi"
                                    >
                                        {valueOrDash(artikel.lokasi)}
                                    </InfoCard>
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