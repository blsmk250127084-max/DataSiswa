<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class Home extends BaseController
{
    private const PAGE_SIZE = 5;

    public function index(): string
    {
        $search = trim((string) $this->request->getGet('search'));
        $kelas  = trim((string) $this->request->getGet('kelas'));
        $page   = $this->validPage($this->request->getGet('page')) ?? 1;

        $model = new SiswaModel();
        $builder = $model->builder();
        $builder->orderBy('id', 'ASC');

        if ($search !== '') {
            $builder->groupStart()
                ->like('nama', $search, 'both')
                ->orLike('nis', $search, 'both')
                ->orLike('kelas', $search, 'both')
                ->groupEnd();
        }

        if ($kelas !== '' && $kelas !== 'Semua') {
            $builder->where('kelas', $kelas);
        }

        $totalData = $builder->countAllResults(false);
        $totalPages = max(1, (int) ceil($totalData / self::PAGE_SIZE));
        $page = min(max(1, $page), $totalPages);

        $result = $builder->limit(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE)
            ->get()
            ->getResultArray();

        $data['siswa'] = $result;
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalPages;
        $data['search'] = $search;
        $data['kelasSelected'] = $kelas !== '' ? $kelas : 'Semua';
        $data['totalSiswa'] = $totalData;
        $data['filterOptions'] = $this->getAvailableClasses();
        $data['showCreate'] = false;

        $data['summaryLaki'] = $this->countNamePattern($model, 'budi');
        $data['summaryPerempuan'] = $this->countNamePattern($model, 'putri');

        return view('siswa_view', $data);
    }

    public function create(): string
    {
        return $this->index();
    }

    public function store()
    {
        if (strtoupper($this->request->getMethod()) === 'GET') {
            return redirect()->to('/');
        }

        $page = $this->validPage($this->request->getPost('page'));
        if ($page === null) {
            return redirect()->to($this->pageUrl(1))->with('error', 'Halaman siswa tidak valid.');
        }

        $nisInput = $this->request->getPost('nis');
        $namaInput = $this->request->getPost('nama');
        $kelasInput = $this->request->getPost('kelas');

        if (! is_string($nisInput) || ! is_string($namaInput) || ! is_string($kelasInput)) {
            return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa tidak valid.');
        }

        $nis = trim($nisInput);
        $nama = trim($namaInput);
        $kelas = trim($kelasInput);

        if ($nis === '' || $nama === '' || $kelas === '') {
            return redirect()->to($this->pageUrl($page))->withInput()->with('error', 'Semua field wajib diisi: NIS, Nama, dan Kelas.');
        }

        $model = new SiswaModel();
        $data = [
            'nis'   => $nis,
            'nama'  => $nama,
            'kelas' => $kelas,
            'page'  => $page,
        ];

        if ($model->save($data)) {
            return redirect()->to($this->pageUrl($page))->with('success', 'Data siswa berhasil ditambahkan.');
        }

        $errors = $model->errors();
        $message = is_array($errors) && ! empty($errors)
            ? implode(', ', array_values($errors))
            : 'Data siswa gagal disimpan ke database.';

        return redirect()->to($this->pageUrl($page))->withInput()->with('error', $message);
    }

    public function update($id = null)
    {
        if (strtoupper($this->request->getMethod()) !== 'POST') {
            return redirect()->to('/');
        }

        $page = $this->validPage($this->request->getPost('page'));
        if ($page === null) {
            return redirect()->to($this->pageUrl(1))->with('error', 'Halaman siswa tidak valid.');
        }

        if ($id === null || ! is_numeric($id)) {
            return redirect()->to($this->pageUrl($page))->with('error', 'ID siswa tidak valid.');
        }

        $model = new SiswaModel();
        $student = $model->find($id);
        if ($student === null) {
            return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa tidak ditemukan.');
        }

        $editableFields = ['nis', 'nama', 'kelas'];
        $data = [];
        foreach ($editableFields as $field) {
            $value = $this->request->getPost($field);
            if ($value === null) {
                continue;
            }
            if (! is_string($value)) {
                return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa tidak valid.');
            }

            $value = trim($value);
            if ($value === '') {
                return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa tidak boleh kosong.');
            }
            $data[$field] = $value;
        }

        if ($data === []) {
            return redirect()->to($this->pageUrl($page))->with('error', 'Tidak ada perubahan data siswa.');
        }

        if ($model->update($id, $data)) {
            return redirect()->to($this->pageUrl($page))->with('success', 'Data siswa berhasil diperbarui.');
        }

        $errors = $model->errors();
        $message = is_array($errors) && ! empty($errors)
            ? implode(', ', array_values($errors))
            : 'Data siswa gagal diperbarui.';

        return redirect()->to($this->pageUrl($page))->with('error', $message);
    }

    public function delete($id = null)
    {
        if (strtoupper($this->request->getMethod()) !== 'POST') {
            return redirect()->to('/');
        }

        $page = $this->validPage($this->request->getPost('page'));
        if ($page === null) {
            return redirect()->to($this->pageUrl(1))->with('error', 'Halaman siswa tidak valid.');
        }

        if ($id === null || ! is_numeric($id)) {
            return redirect()->to($this->pageUrl($page))->with('error', 'ID siswa tidak valid.');
        }

        $model = new SiswaModel();
        $student = $model->find($id);
        if ($student === null) {
            return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa tidak ditemukan.');
        }

        if ($model->delete($id)) {
            return redirect()->to($this->pageUrl($page))->with('success', 'Data siswa berhasil dihapus.');
        }

        return redirect()->to($this->pageUrl($page))->with('error', 'Data siswa gagal dihapus.');
    }

    private function validPage($value): ?int
    {
        if (! is_scalar($value) || ! ctype_digit((string) $value)) {
            return null;
        }

        $page = (int) $value;

        return $page >= 1 ? $page : null;
    }

    private function pageUrl(int $page, ?string $search = null, ?string $kelas = null): string
    {
        $query = ['page' => $page];

        if (is_string($search) && $search !== '') {
            $query['search'] = $search;
        }

        if (is_string($kelas) && $kelas !== '' && $kelas !== 'Semua') {
            $query['kelas'] = $kelas;
        }

        return site_url('/?' . http_build_query($query));
    }

    private function getAvailableClasses(): array
    {
        $model = new SiswaModel();
        $rows = $model->select('kelas')->distinct()->orderBy('kelas', 'ASC')->findAll();

        $classes = ['Semua'];
        foreach ($rows as $row) {
            $kelas = trim((string) ($row['kelas'] ?? ''));
            if ($kelas !== '') {
                $classes[] = $kelas;
            }
        }

        return array_values(array_unique($classes));
    }

    private function countNamePattern(SiswaModel $model, string $pattern): int
    {
        $escapedPattern = strtolower(trim($pattern));
        if ($escapedPattern === '') {
            return 0;
        }

        return $model->groupStart()
            ->like('LOWER(nama)', $escapedPattern, 'after')
            ->orLike('LOWER(nama)', $escapedPattern, 'before')
            ->groupEnd()
            ->countAllResults();
    }
}