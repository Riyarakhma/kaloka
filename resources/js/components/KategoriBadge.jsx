import { KATEGORI } from '../lib/kategori';

export default function KategoriBadge({ id, size = 'md' }) {
    const kategori = KATEGORI[id];
    if (!kategori) return null;

    const sizeClass = size === 'sm' ? 'text-xs px-2.5 py-1' : 'text-sm px-3 py-1.5';

    return (
        <span
            className={`inline-flex items-center gap-1.5 rounded-full font-semibold ${sizeClass} ${kategori.badgeClass}`}
        >
            <span className={`size-2 rounded-full ${kategori.dotClass}`} />
            {kategori.label}
        </span>
    );
}