import { KATEGORI } from '../lib/kategori';

export default function KategoriBadge({ id, size = 'md' }) {
    const kategori = KATEGORI[id];

    if (!kategori) return null;

    const sizeClass =
        size === 'sm'
            ? 'text-xs px-2.5 py-1'
            : 'text-sm px-3 py-1.5';

    return (
        <span
            className={`inline-flex self-start items-center rounded-full font-semibold ${sizeClass} ${kategori.badgeClass}`}
        >
            {kategori.label}
        </span>
    );
}