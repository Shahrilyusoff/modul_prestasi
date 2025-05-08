<?php

// app/Helpers/Helpers.php

namespace App\Helpers;

class Helpers
{
    public static function getKriteriaLabel($bahagian, $key)
    {
        $kriteria = [
            'iii' => [
                1 => 'KUANTITI HASIL KERJA - Kuantiti hasil kerja seperti jumlah, bilangan, kadar, kekerapan dan sebagainya berbanding dengan sasaran kuantiti kerja yang diterapkan',
                2 => 'KUALITI HASIL KERJA - Dinilai dari segi kesempurnaan, teratur dan kemas serta usaha dan inisiatif untuk mencapai kesempurnaan hasil kerja',
                3 => 'KETEPATAN MASA - Kebolehan menghasilkan kerja atau melaksanakan tugas dalam tempoh masa yang ditetapkan',
                4 => 'KEBERKESANAN HASIL KERJA - Dinilai dari segi memenuhi kehendak stake-holder atau pelanggan'
            ],
            'iv' => [
                1 => 'ILMU PENGETAHUAN DAN KEMAHIRAN DALAM BIDANG KERJA - Mempunyai ilmu pengetahuan dan kemahiran/kepakaran dalam menghasilkan kerja meliputi kebolehan mengenalpasti, menganalisis serta menyelesaikan masalah',
                2 => 'PELAKSANAAN DASAR, PERATURAN DAN ARAHAN PENTADBIRAN - Kebolehan menghayati dan melaksanakan dasar, peraturan dan arahan pentadbiran berkaitan dengan bidang tugasnya',
                3 => 'KEBERKESANAN KOMUNIKASI - Kebolehan menyampaikan maksud, pendapat, kefahaman atau arahan secara lisan dan tulisan berkaitan dengan bidang tugas merangkumi penguasaan Bahasa melalui tulisan dan lisan dengan menggunakan tatabahasa dan persembahan yang baik'
            ],
            'v' => [
                1 => 'CIRI-CIRI MEMIMPIN - Mempunyai wawasan, komitmen, kebolehan membuat keputusan, menggerak dan memberi dorongan kepada pegawai kearah pencapaian objektif organisasi',
                2 => 'KEBOLEHAN MENGELOLA - Keupayaan dan kebolehan menggembleng segala sumber dalam kawalannya seperti kewangan, tenaga manusia, peralatan dan maklumat bagi merancang, mengatur, membahagi dan mengendalikan sesuatu tugas untuk mencapai objektif organisasi',
                3 => 'DISIPLIN - Mempunyai daya kawal diri dari segi mental dan fizikal termasuk mematuhi peraturan, menepati masa, menunaikan janji dan bersifat sabar',
                4 => 'PROAKTIF DAN INOVATIF - Kebolehan menjangka kemungkinan, mencipta dan mengeluarkan idea baru serta membuat pembaharuan bagi mempertingkatkan kualiti dan produktiviti organisasi',
                5 => 'JALINAN HUBUNGAN DAN KERJASAMA - Kebolehan pegawai dalam mewujudkan suasana kerjasama yang harmoni dan mesra serta boleh menyesuaikan diri dalam semua keadaan'
            ]
        ];

        return $kriteria[$bahagian][$key] ?? '';
    }
}
