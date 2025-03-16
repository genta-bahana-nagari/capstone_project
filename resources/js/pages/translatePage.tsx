import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { useState } from 'react';

const TranslatePage: React.FC = () => {
    const [text, setText] = useState<string>('');
    const [translatedText, setTranslatedText] = useState<string>('');
    const [language, setLanguage] = useState<string>('id'); // Default: Bahasa Indonesia

    const handleTranslate = async (): Promise<void> => {
        try {
            const response = await fetch(
                `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${language}&dt=t&q=${encodeURIComponent(text)}`,
            );
            const data = await response.json();

            // Google Translate API mengembalikan array bersarang, jadi kita perlu mengambil hasilnya dengan benar
            // eslint-disable-next-line @typescript-eslint/no-explicit-any
            setTranslatedText(data[0].map((t: any) => t[0]).join(' '));
        } catch (error) {
            console.error('Terjadi kesalahan saat menerjemahkan:', error);
        }
    };

    return (
        <AppLayout breadcrumbs={[{ title: 'Translate', href: '/translate' }]}>
            <Head title="Translate" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-1">
                    {/* Input Text */}
                    <div className="relative aspect-auto overflow-hidden rounded-xl border p-4">
                        <textarea
                            placeholder="Masukkan teks (misal: Hello World)"
                            value={text}
                            onChange={(e) => setText(e.target.value)}
                            className="h-32 w-full rounded-md border p-2"
                        ></textarea>
                        {/* Pilihan Bahasa */}
                        <select value={language} onChange={(e) => setLanguage(e.target.value)} className="mt-4 block w-full rounded-md border p-2">
                            <option value="id">Bahasa Indonesia</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="zh">Chinese</option>
                        </select>
                        {/* Tombol Translate */}
                        <button
                            onClick={handleTranslate}
                            className="mt-4 w-full rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        >
                            Translate
                        </button>
                    </div>
                    {/* Hasil Terjemahan */}
                    <div className="relative aspect-auto overflow-hidden rounded-xl border p-4">
                        <h3 className="mb-2 font-bold">Translated Text:</h3>
                        <p className="text-gray-700 dark:text-gray-300">{translatedText || 'Hasil terjemahan akan muncul di sini'}</p>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
};

export default TranslatePage;
