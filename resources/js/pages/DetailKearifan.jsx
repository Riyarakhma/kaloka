import { Link, useParams } from 'react-router-dom';
import {
    ArrowLeft,
    CalendarDays,
    Camera,
    CheckCircle2,
    FileText,
    Languages,
    MapPin,
    ShieldCheck,
    Tag,
    UserRound,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

import {
    KEARIFAN_ITEMS,
    KATEGORI_KEARIFAN,
} from '../data/kearifanData';

function InformationCard({ icon: Icon, title, children }) {
    return (
        <section className="rounded-2xl border border-border bg-card p-5 shadow-sm">
            <div className="flex items-start gap-4">
                <div className="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <Icon className="size-5" />
                </div>

                <div className="min-w-0">
                    <h2 className="font-semibold text-foreground">
                        {title}
                    </h2>

                    <div className="mt-2 text-sm leading-6 text-muted-foreground">
                        {children}
                    </div>
                </div>
            </div>
        </section>
    );
}

function StatusBadge({ children }) {
    return (
        <span className="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">
            {children}
        </span>
    );
}

export default function DetailKearifan() {
    const { slug } = useParams();

    const artikel = KEARIFAN_ITEMS.find(
        (item) => item.slug === slug,
    );

    if (!artikel) {
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

    const kategoriLabel =
        KATEGORI_KEARIFAN.find(
            (kategori) => kategori.id === artikel.kategori,
        )?.label ?? artikel.kategori;

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

                <div className="mt-8 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
                    <article className="overflow-hidden rounded-3xl border border-border bg-card shadow-sm">
                        <figure className="aspect-[16/9] overflow-hidden bg-muted">
                            <img
                                src={artikel.foto}
                                alt={artikel.judul}
                                className="h-full w-full object-cover"
                            />
                        </figure>

                        <div className="p-6 md:p-9">
                            <span className="inline-flex rounded-full bg-primary/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-wide text-primary">
                                {kategoriLabel}
                            </span>

                            <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                {artikel.judul}
                            </h1>

                            <p className="mt-4 text-lg leading-8 text-muted-foreground">
                                {artikel.deskripsi}
                            </p>

                            <section className="mt-9">
                                <h2 className="text-lg font-bold text-foreground">
                                    Deskripsi
                                </h2>

                                <div className="mt-4 space-y-5">
                                    {artikel.isi.map((paragraf, index) => (
                                        <p
                                            key={`${artikel.slug}-${index}`}
                                            className="text-base leading-8 text-foreground/80 md:text-lg"
                                        >
                                            {paragraf}
                                        </p>
                                    ))}
                                </div>
                            </section>

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

                            <section className="mt-9 border-t border-border pt-8">
                                <h2 className="text-lg font-bold text-foreground">
                                    Narasumber
                                </h2>

                                <div className="mt-5 flex items-center gap-4 rounded-2xl bg-muted/50 p-5">
                                    <div className="flex size-14 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <UserRound className="size-7" />
                                    </div>

                                    <div>
                                        <h3 className="font-semibold text-foreground">
                                            {artikel.narasumber.nama}
                                        </h3>

                                        <p className="mt-1 text-sm text-muted-foreground">
                                            {artikel.narasumber.keterangan}
                                        </p>

                                        <p className="text-sm text-muted-foreground">
                                            {artikel.narasumber.asal}
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <aside className="mt-9 rounded-2xl border border-primary/15 bg-primary-soft/50 p-6">
                                <h2 className="font-display text-xl text-primary">
                                    Lestarikan Kearifan, Jaga Warisan
                                </h2>

                                <p className="mt-2 leading-7 text-muted-foreground">
                                    Kearifan lokal merupakan identitas dan
                                    kekayaan bersama yang perlu dijaga serta
                                    diwariskan kepada generasi mendatang.
                                </p>
                            </aside>
                        </div>
                    </article>

                    <aside className="space-y-4 lg:sticky lg:top-24">
                        <InformationCard
                            icon={MapPin}
                            title="Lokasi"
                        >
                            <p>{artikel.lokasi}</p>
                        </InformationCard>

                        <InformationCard
                            icon={Languages}
                            title="Bahasa"
                        >
                            <p>{artikel.bahasa}</p>
                        </InformationCard>

                        <InformationCard
                            icon={Camera}
                            title="Jenis Media"
                        >
                            <p>{artikel.jenisMedia}</p>
                        </InformationCard>

                        <InformationCard
                            icon={CalendarDays}
                            title="Tanggal Dokumentasi"
                        >
                            <p>{artikel.tanggalDokumentasi}</p>
                        </InformationCard>

                        <InformationCard
                            icon={UserRound}
                            title="Pendokumentasi"
                        >
                            <p>{artikel.pendokumentasi}</p>
                        </InformationCard>

                        <InformationCard
                            icon={FileText}
                            title="Sumber"
                        >
                            <p>{artikel.sumber}</p>
                        </InformationCard>

                        <InformationCard
                            icon={ShieldCheck}
                            title="Status Etis"
                        >
                            <StatusBadge>
                                {artikel.statusEtis.label}
                            </StatusBadge>

                            <p className="mt-3">
                                {artikel.statusEtis.keterangan}
                            </p>
                        </InformationCard>

                        <InformationCard
                            icon={CheckCircle2}
                            title="Status Kurasi"
                        >
                            <StatusBadge>
                                {artikel.statusKurasi.label}
                            </StatusBadge>

                            <p className="mt-3">
                                {artikel.statusKurasi.keterangan}
                            </p>
                        </InformationCard>

                        <InformationCard
                            icon={Tag}
                            title="Kategori"
                        >
                            <p>{kategoriLabel}</p>
                        </InformationCard>
                    </aside>
                </div>
            </main>

            <Footer />
        </div>
    );
}