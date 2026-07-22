import { Link, useParams } from 'react-router-dom';
import {
    ArrowLeft,
    Clock,
    Eye,
    MapPin,
    Phone,
    Store,
    Tag,
    User,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import { UMKM_ITEMS } from '../data/umkmData';

export default function DetailUMKM() {
    const { slug } = useParams();

    const umkm = UMKM_ITEMS.find(
        (item) =>
            item.slug === slug &&
            item.status_tampil === true,
    );

    if (!umkm) {
        return (
            <div className="min-h-screen bg-background">
                <Navbar />

                <main className="container-page flex min-h-[70vh] flex-col items-center justify-center py-20 text-center">
                    <Store className="mb-5 size-16 text-primary" />

                    <h1 className="font-display text-4xl text-foreground">
                        UMKM Tidak Ditemukan
                    </h1>

                    <p className="mt-3 max-w-lg text-lg text-muted-foreground">
                        Data UMKM yang kamu cari tidak tersedia atau sedang
                        tidak ditampilkan.
                    </p>

                    <Link
                        to="/umkm"
                        className="mt-7 inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 font-semibold text-white transition hover:opacity-90"
                    >
                        <ArrowLeft className="size-5" />
                        Kembali ke Galeri UMKM
                    </Link>
                </main>

                <Footer />
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <main>
                <section className="border-b border-border bg-primary-soft/60">
                    <div className="container-page py-8 md:py-12">
                        <Link
                            to="/umkm"
                            className="inline-flex items-center gap-2 font-semibold text-primary transition hover:gap-3"
                        >
                            <ArrowLeft className="size-5" />
                            Kembali ke Galeri UMKM
                        </Link>

                        <div className="mt-8 grid gap-8 lg:grid-cols-[1.35fr_0.65fr] lg:items-start">
                            <div>
                                <div className="flex flex-wrap items-center gap-3">
                                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                                        <Tag className="size-4" />
                                        {umkm.kategori}
                                    </span>

                                    <span className="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-semibold text-emerald-700">
                                        <Eye className="size-4" />
                                        Ditampilkan
                                    </span>
                                </div>

                                <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                    {umkm.nama_umkm}
                                </h1>

                                {umkm.alamat && (
                                    <p className="mt-5 flex items-start gap-3 text-base leading-7 text-muted-foreground md:text-lg">
                                        <MapPin className="mt-1 size-5 shrink-0 text-primary" />
                                        <span>{umkm.alamat}</span>
                                    </p>
                                )}

                                <p className="mt-6 max-w-3xl text-lg leading-8 text-muted-foreground">
                                    {umkm.deskripsi}
                                </p>
                            </div>

                            <div className="overflow-hidden rounded-3xl border border-border bg-card shadow-sm">
                                {umkm.foto ? (
                                    <img
                                        src={umkm.foto}
                                        alt={umkm.nama_umkm}
                                        className="aspect-[4/3] w-full object-cover"
                                    />
                                ) : (
                                    <div className="flex aspect-[4/3] w-full flex-col items-center justify-center gap-3 bg-primary-soft/50 text-muted-foreground">
                                        <Store className="size-16 text-primary" />

                                        <span className="font-medium">
                                            Foto belum tersedia
                                        </span>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </section>

                <section className="container-page py-10 md:py-14">
                    <div className="grid gap-8 lg:grid-cols-[1fr_360px]">
                        <div className="space-y-8">
                            <article className="rounded-3xl border border-border bg-card p-6 shadow-sm md:p-8">
                                <h2 className="font-display text-2xl text-foreground">
                                    Tentang Usaha
                                </h2>

                                <p className="mt-4 whitespace-pre-line text-base leading-8 text-muted-foreground">
                                    {umkm.deskripsi}
                                </p>
                            </article>

                            <article className="rounded-3xl border border-border bg-card p-6 shadow-sm md:p-8">
                                <h2 className="font-display text-2xl text-foreground">
                                    Informasi Selengkapnya
                                </h2>

                                <div className="mt-5 space-y-5 text-base leading-8 text-muted-foreground">
                                    {Array.isArray(
                                        umkm.informasi_selengkapnya,
                                    ) &&
                                    umkm.informasi_selengkapnya.length > 0 ? (
                                        umkm.informasi_selengkapnya.map(
                                            (paragraf, index) => (
                                                <p key={index}>
                                                    {paragraf}
                                                </p>
                                            ),
                                        )
                                    ) : umkm.informasi_selengkapnya ? (
                                        <p>
                                            {
                                                umkm.informasi_selengkapnya
                                            }
                                        </p>
                                    ) : (
                                        <p>
                                            Informasi lebih lanjut mengenai
                                            usaha ini belum tersedia.
                                        </p>
                                    )}
                                </div>
                            </article>
                        </div>

                        <aside className="h-fit rounded-3xl border border-border bg-card p-6 shadow-sm lg:sticky lg:top-24">
                            <h2 className="font-display text-2xl text-foreground">
                                Informasi UMKM
                            </h2>

                            <div className="mt-6 space-y-5">
                                <InfoItem
                                    icon={User}
                                    label="Pemilik"
                                    value={
                                        umkm.pemilik ||
                                        'Belum tersedia'
                                    }
                                />

                                <Divider />

                                <InfoItem
                                    icon={MapPin}
                                    label="Alamat"
                                    value={
                                        umkm.alamat ||
                                        'Belum tersedia'
                                    }
                                />

                                <Divider />

                                <InfoItem
                                    icon={Phone}
                                    label="Kontak"
                                    value={
                                        umkm.kontak ||
                                        'Belum tersedia'
                                    }
                                />

                                <Divider />

                                <InfoItem
                                    icon={Clock}
                                    label="Jam Operasional"
                                    value={
                                        umkm.jam_operasional ||
                                        'Belum tersedia'
                                    }
                                />

                                <Divider />

                                <InfoItem
                                    icon={Store}
                                    label="Kategori"
                                    value={umkm.kategori}
                                />

                                <Divider />

                                <InfoItem
                                    icon={Eye}
                                    label="Status Tampil"
                                    value={
                                        umkm.status_tampil
                                            ? 'Ditampilkan'
                                            : 'Disembunyikan'
                                    }
                                />
                            </div>
                        </aside>
                    </div>
                </section>
            </main>

            <Footer />
        </div>
    );
}

function InfoItem({
    icon: Icon,
    label,
    value,
}) {
    return (
        <div className="flex items-start gap-4">
            <div className="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-primary-soft text-primary">
                <Icon className="size-5" />
            </div>

            <div className="min-w-0">
                <p className="text-sm text-muted-foreground">
                    {label}
                </p>

                <p className="mt-1 break-words font-semibold leading-7 text-foreground">
                    {value}
                </p>
            </div>
        </div>
    );
}

function Divider() {
    return <div className="border-t border-border" />;
}