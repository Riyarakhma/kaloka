import { Link } from 'react-router-dom';
import { ArrowLeft } from 'lucide-react';

export default function BackToHome() {
    return (
        <Link
            to="/"
            className="group inline-flex items-center gap-2 text-sm font-medium text-muted-foreground transition hover:text-primary"
        >
            <span className="grid size-8 place-items-center rounded-full border border-border bg-background transition group-hover:border-primary group-hover:bg-primary-soft">
                <ArrowLeft className="size-4" />
            </span>

            Kembali ke Beranda
        </Link>
    );
}