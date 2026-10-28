<?php
$currentPage = isset($currentPage) && is_scalar($currentPage) ? (int) $currentPage : 1;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa XI RPL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: #f4f7fb;
            --sidebar-bg: #172b4d;
            --sidebar-muted: #a9bad3;
            --ink: #26364a;
            --muted: #78879a;
            --line: #e7edf4;
            --primary: #3978d4;
            --danger: #df5363;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--page-bg);
            color: var(--ink);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            min-height: 100vh;
            padding: 28px 18px;
            background: var(--sidebar-bg);
            color: #fff;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 32px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 12px;
            background: #fff;
        }

        .brand-mark svg {
            width: 28px;
            height: 28px;
            display: block;
        }

        .brand-text h1 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .brand-text p {
            margin: 3px 0 0;
            color: var(--sidebar-muted);
            font-size: 0.76rem;
        }

        .sidebar-caption {
            margin: 0 12px 10px;
            color: #8194b0;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 9px;
            color: var(--sidebar-muted);
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
        }

        .sidebar-link.active {
            background: #2e5e9d;
            color: #fff;
        }

        .sidebar-link-icon {
            width: 20px;
            text-align: center;
            font-size: 1.05rem;
        }

        .main-area {
            min-width: 0;
            flex: 1;
            padding: 28px clamp(20px, 4vw, 56px);
        }

        .admin-header {
            min-height: 52px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            margin-bottom: 30px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #e4edfb;
            color: var(--primary);
            font-weight: 700;
        }

        .admin-panel {
            width: min(1280px, 100%);
            margin: 0 auto;
        }

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-heading h2 {
            margin: 0;
            color: var(--ink);
            font-size: clamp(1.45rem, 2.2vw, 1.85rem);
            font-weight: 700;
        }

        .page-heading p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 0.93rem;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .search-box,
        .filter-box {
            position: relative;
        }

        .search-box {
            width: min(310px, 32vw);
        }

        .search-box input,
        .filter-box select {
            width: 100%;
            height: 42px;
            border: 1px solid #dce4ee;
            border-radius: 8px;
            background: #fff;
            color: var(--ink);
            padding: 0 38px 0 13px;
            font-size: 0.9rem;
            outline: none;
        }

        .search-box input:focus,
        .filter-box select:focus {
            border-color: #8eb3e9;
            box-shadow: 0 0 0 3px rgba(57, 120, 212, 0.12);
        }

        .search-box input::placeholder {
            color: #9aa8b8;
        }

        .search-box .search-icon {
            position: absolute;
            top: 50%;
            right: 13px;
            width: 17px;
            height: 17px;
            transform: translateY(-50%);
        }

        .filter-box {
            width: 155px;
        }

        .filter-box select {
            padding-right: 28px;
        }

        .add-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 16px;
            border: 0;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(57, 120, 212, 0.18);
        }

        .add-btn:hover {
            background: #2e68bd;
            color: #fff;
        }

        .add-btn span {
            font-size: 1.2rem;
            line-height: 1;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin: 0 0 24px;
        }

        .stat-card {
            min-height: 104px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 20px 22px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(30, 55, 90, 0.04);
        }

        .stat-card .label {
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 600;
        }

        .stat-card .value {
            color: var(--ink);
            font-size: 1.65rem;
            font-weight: 700;
        }

        .table-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(30, 55, 90, 0.04);
        }

        .table-card-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--line);
        }

        .table-card-heading h3 {
            margin: 0;
            color: var(--ink);
            font-size: 1rem;
            font-weight: 700;
        }

        .table-card-heading p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.82rem;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 14px 18px;
            border-bottom: 1px solid var(--line);
            background: #f8fafd;
            color: #627186;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody td {
            padding: 9px 14px;
            border-bottom: 1px solid #edf1f6;
            background: #fff;
            color: var(--ink);
            font-size: 0.9rem;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:hover td {
            background: #fbfcfe;
        }

        .inline-edit-form {
            margin: 0;
        }

        .inline-edit-input {
            width: 100%;
            min-width: 0;
            padding: 8px 9px;
            border: 1px solid transparent;
            border-radius: 6px;
            background: transparent;
            color: var(--ink);
            font: inherit;
            outline: none;
        }

        .inline-edit-input:hover {
            border-color: #e3eaf3;
        }

        .inline-edit-input:focus {
            border-color: #8eb3e9;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(57, 120, 212, 0.1);
        }

        .action-cell {
            width: 90px;
            text-align: center;
        }

        .delete-form {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .delete-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #f6d5d9;
            border-radius: 7px;
            background: #fff5f6;
            color: var(--danger);
            transition: background 0.15s ease, color 0.15s ease;
        }

        .delete-btn:hover {
            background: var(--danger);
            color: #fff;
        }

        .delete-btn svg {
            width: 15px;
            height: 15px;
        }

        .pagination-wrap {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 18px;
            padding-bottom: 8px;
        }

        .pager-btn {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 9px;
            border: 1px solid #dfe6ef;
            border-radius: 7px;
            background: #fff;
            color: #5e6f84;
            font-size: 0.86rem;
            font-weight: 600;
            text-decoration: none;
        }

        .pager-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pager-btn.active {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }

        .pager-btn.ghost {
            background: #fff;
            color: #5e6f84;
        }

        .pager-btn.disabled {
            pointer-events: none;
            opacity: 0.45;
        }

        .modal-content {
            color: var(--ink);
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
                flex-basis: 210px;
            }

            .main-area {
                padding: 22px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .toolbar,
            .toolbar form {
                width: 100%;
                justify-content: flex-start;
            }

            .search-box {
                width: min(330px, 100%);
            }
        }

        @media (max-width: 640px) {
            .admin-shell {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: 0;
                padding: 14px 16px;
            }

            .sidebar-brand {
                padding: 0;
            }

            .sidebar-caption,
            .sidebar-link {
                display: none;
            }

            .main-area {
                padding: 18px 14px;
            }

            .admin-header {
                min-height: 38px;
                margin-bottom: 20px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .toolbar form {
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .filter-box {
                width: calc(50% - 5px);
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stat-card {
                min-height: 82px;
            }

            .table-card-heading {
                padding: 15px;
            }

            thead th,
            tbody td {
                padding-right: 10px;
                padding-left: 10px;
            }

            .pagination-wrap {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        :root {
            --page-bg: #14283b;
            --sidebar-bg: #18384c;
            --sidebar-muted: #c3d6e1;
            --ink: #edf5fb;
            --muted: #abc0ce;
            --line: rgba(195, 220, 236, 0.2);
            --primary: #2d83dc;
            --danger: #e44156;
        }

        body {
            background:
                radial-gradient(ellipse at 75% 25%, rgba(87, 144, 177, 0.28), transparent 38%),
                linear-gradient(120deg, #15364b 0%, #1a3448 55%, #1e2d40 100%);
            color: var(--ink);
        }

        .admin-shell {
            background:
                linear-gradient(110deg, transparent 0 59%, rgba(255,255,255,0.025) 59.1%, transparent 59.4%),
                transparent;
        }

        .sidebar {
            width: 190px;
            flex-basis: 190px;
            padding: 18px 9px;
            border-right: 1px solid rgba(201, 225, 238, 0.15);
            background: linear-gradient(180deg, rgba(28, 63, 82, 0.94), rgba(22, 43, 61, 0.96));
            box-shadow: 8px 0 28px rgba(4, 17, 29, 0.12);
        }

        .sidebar-brand {
            gap: 10px;
            padding: 0 8px 20px;
            border-bottom: 1px solid rgba(210, 230, 240, 0.13);
            margin-bottom: 18px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
            border: 2px solid rgba(222, 243, 255, 0.28);
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .brand-text h1 {
            color: #eef7fc;
            font-size: 0.88rem;
        }

        .brand-text p {
            color: #afc5d2;
            font-size: 0.7rem;
        }

        .sidebar-caption {
            margin: 0 10px 7px;
            color: #8fa9ba;
            letter-spacing: 0.08em;
        }

        .sidebar-link {
            min-height: 38px;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 8px;
            color: #cfdee7;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .sidebar-link + .sidebar-link {
            margin-top: 3px;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(177, 214, 233, 0.2);
            color: #fff;
        }

        .sidebar-action {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
        }

        .main-area {
            padding: 0 clamp(18px, 2vw, 28px) 24px;
        }

        .admin-header {
            min-height: 56px;
            justify-content: space-between;
            margin-bottom: 17px;
            border-bottom: 1px solid rgba(192, 218, 234, 0.16);
        }

        .header-path {
            color: #d7e5ed;
            font-size: 0.9rem;
        }

        .header-path strong {
            color: #fff;
        }

        .admin-profile {
            color: #eef7fc;
            font-size: 0.78rem;
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            border: 1px solid rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .admin-panel {
            width: min(1120px, 100%);
        }

        .page-heading {
            margin-bottom: 14px;
        }

        .page-heading h2 {
            color: #eef6fb;
            font-size: clamp(1.45rem, 2vw, 1.8rem);
        }

        .page-heading p {
            color: #b6cad6;
        }

        .topbar {
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .toolbar {
            gap: 9px;
        }

        .search-box {
            width: min(205px, 24vw);
        }

        .search-box input,
        .filter-box select {
            height: 36px;
            border-color: rgba(213, 233, 244, 0.17);
            border-radius: 18px;
            background: rgba(229, 243, 250, 0.08);
            color: #edf6fb;
            font-size: 0.78rem;
        }

        .search-box input::placeholder {
            color: #a7bdcb;
        }

        .filter-box {
            width: 110px;
        }

        .filter-box select option {
            background: #20394c;
            color: #edf6fb;
        }

        .search-box .search-icon {
            opacity: 0.8;
        }

        .add-btn {
            min-height: 36px;
            padding: 0 13px;
            border: 1px solid rgba(228, 242, 250, 0.5);
            border-radius: 19px;
            background: #e2f2fb;
            color: #18364a;
            font-size: 0.78rem;
            box-shadow: 0 5px 14px rgba(2, 16, 29, 0.18);
        }

        .add-btn:hover {
            background: #fff;
            color: #18364a;
        }

        .stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-card {
            min-height: 64px;
            padding: 10px 13px;
            border: 1px solid rgba(205, 230, 243, 0.2);
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(219, 239, 249, 0.1), rgba(207, 228, 240, 0.045));
            box-shadow: 0 7px 18px rgba(4, 17, 29, 0.12), inset 0 1px rgba(255,255,255,0.08);
        }

        .stat-card .label {
            color: #d4e4ec;
            font-size: 0.78rem;
        }

        .stat-card .value {
            color: #f0f8fc;
            font-size: 1.2rem;
        }

        .table-card {
            border-color: rgba(207, 231, 244, 0.25);
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(22, 44, 62, 0.76), rgba(35, 48, 66, 0.68));
            box-shadow: 0 14px 28px rgba(4, 14, 25, 0.22), inset 0 1px rgba(255,255,255,0.06);
            backdrop-filter: blur(12px);
        }

        .table-card-heading {
            padding: 12px 16px;
            border-bottom-color: rgba(210, 230, 241, 0.15);
        }

        .table-card-heading h3 {
            color: #edf6fb;
            font-size: 0.9rem;
        }

        .table-card-heading p {
            color: #b0c5d1;
        }

        thead th {
            padding: 10px 14px;
            border-bottom-color: rgba(210, 230, 241, 0.16);
            background: rgba(220, 238, 247, 0.08);
            color: #e0edf4;
            font-size: 0.76rem;
            text-transform: none;
            letter-spacing: 0;
        }

        tbody td {
            padding: 5px 10px;
            border-bottom-color: rgba(213, 232, 241, 0.13);
            background: rgba(255, 255, 255, 0.015);
            color: #edf5fa;
            font-size: 0.8rem;
        }

        tbody tr:nth-child(even) td {
            background: rgba(225, 240, 248, 0.035);
        }

        tbody tr:hover td {
            background: rgba(221, 240, 250, 0.1);
        }

        .inline-edit-input {
            padding: 7px 8px;
            color: #edf5fa;
            font-size: 0.8rem;
        }

        .inline-edit-input:hover {
            border-color: rgba(207, 230, 241, 0.18);
        }

        .inline-edit-input:focus {
            border-color: rgba(169, 210, 237, 0.7);
            background: rgba(228, 242, 250, 0.12);
            color: #fff;
            box-shadow: 0 0 0 2px rgba(72, 143, 201, 0.18);
        }

        .delete-btn {
            width: 27px;
            height: 27px;
            border: 0;
            border-radius: 50%;
            background: rgba(223, 65, 85, 0.92);
            color: #fff;
            box-shadow: 0 4px 10px rgba(201, 40, 63, 0.25);
        }

        .delete-btn:hover {
            background: #f04e63;
            color: #fff;
        }

        .pagination-wrap {
            justify-content: center;
            gap: 7px;
            margin-top: 12px;
        }

        .pager-btn {
            min-width: 32px;
            height: 32px;
            border-color: rgba(218, 236, 246, 0.2);
            border-radius: 50%;
            background: rgba(220, 238, 248, 0.13);
            color: #e8f3f8;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.13);
        }

        .pager-btn:hover {
            border-color: #b4d7ea;
            color: #fff;
        }

        .pager-btn.active {
            border-color: #e4f2f9;
            background: #e4f2f9;
            color: #19384d;
        }

        .pager-btn.ghost {
            background: rgba(220, 238, 248, 0.1);
            color: #e8f3f8;
        }

        #modalTambahSiswa .modal-dialog {
            max-width: 470px;
        }

        #modalTambahSiswa .modal-content {
            overflow: hidden;
            border: 1px solid rgba(208, 231, 244, 0.3) !important;
            border-radius: 16px !important;
            background: linear-gradient(145deg, #203e53, #172c40);
            color: #edf5fb;
            box-shadow: 0 24px 70px rgba(2, 12, 22, 0.45) !important;
        }

        #modalTambahSiswa .modal-header {
            align-items: flex-start;
            padding: 22px 24px 14px !important;
        }

        #modalTambahSiswa .modal-title {
            color: #f2f8fc;
            font-size: 1.15rem;
        }

        #modalTambahSiswa .modal-title::after {
            display: block;
            margin-top: 5px;
            color: #aec4d2;
            content: "Isi informasi siswa untuk menambah data baru.";
            font-size: 0.8rem;
            font-weight: 400;
        }

        #modalTambahSiswa .btn-close {
            filter: invert(1) grayscale(1);
            opacity: 0.75;
        }

        #modalTambahSiswa .modal-body {
            padding: 12px 24px 18px !important;
        }

        #modalTambahSiswa .form-label {
            margin-bottom: 7px;
            color: #d7e6ee;
            font-size: 0.82rem;
            font-weight: 600;
        }

        #modalTambahSiswa .form-control {
            min-height: 43px;
            border: 1px solid rgba(210, 232, 243, 0.2);
            border-radius: 8px;
            background: rgba(224, 240, 248, 0.08);
            color: #f4f9fc;
            font-size: 0.88rem;
        }

        #modalTambahSiswa .form-control::placeholder {
            color: #9fb6c5;
        }

        #modalTambahSiswa .form-control:focus {
            border-color: #82b8e4;
            background: rgba(224, 240, 248, 0.12);
            color: #fff;
            box-shadow: 0 0 0 3px rgba(62, 139, 202, 0.2);
        }

        #modalTambahSiswa .modal-footer {
            gap: 8px;
            padding: 0 24px 22px !important;
        }

        #modalTambahSiswa .modal-footer .btn {
            min-height: 39px;
            padding: 0 17px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        #modalTambahSiswa .modal-footer .btn-secondary {
            border: 1px solid rgba(213, 233, 244, 0.22);
            background: rgba(224, 240, 248, 0.08);
            color: #e0edf4;
        }

        #modalTambahSiswa .modal-footer .btn-primary {
            border: 1px solid #78b5e7;
            background: #e2f2fb;
            color: #18364a;
        }

        #modalTambahSiswa .modal-footer .btn-primary:hover {
            background: #fff;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 170px;
                flex-basis: 170px;
            }

            .main-area {
                padding-right: 18px;
                padding-left: 18px;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                width: 100%;
                padding: 12px 14px;
            }

            .sidebar-caption {
                display: block;
                margin-top: 12px;
            }

            .sidebar-link {
                display: flex;
            }

            .main-area {
                padding: 0 14px 20px;
            }

            .admin-header {
                min-height: 52px;
                margin-bottom: 15px;
            }

            .header-path {
                max-width: 58%;
                font-size: 0.75rem;
            }

            .admin-profile {
                font-size: 0.72rem;
            }

            .toolbar,
            .toolbar form {
                width: 100%;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            #modalTambahSiswa .modal-dialog {
                margin: 14px;
            }

            #modalTambahSiswa .modal-header,
            #modalTambahSiswa .modal-body {
                padding-right: 18px !important;
                padding-left: 18px !important;
            }

            #modalTambahSiswa .modal-footer {
                padding-right: 18px !important;
                padding-left: 18px !important;
            }
        }

        @media (min-width: 641px) {
            .sidebar {
                width: 205px;
                flex-basis: 205px;
                padding: 22px 12px;
            }

            .sidebar-brand {
                gap: 12px;
                padding: 0 9px 24px;
                margin-bottom: 22px;
            }

            .brand-mark {
                width: 48px;
                height: 48px;
                flex-basis: 48px;
            }

            .brand-mark svg {
                width: 32px;
                height: 32px;
            }

            .brand-text h1 {
                font-size: 0.98rem;
            }

            .brand-text p {
                font-size: 0.78rem;
            }

            .sidebar-caption {
                margin: 0 12px 9px;
                font-size: 0.72rem;
            }

            .sidebar-link {
                min-height: 43px;
                gap: 11px;
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .sidebar-link-icon {
                width: 22px;
                font-size: 1.15rem;
            }

            .main-area {
                padding-right: clamp(24px, 3vw, 46px);
                padding-left: clamp(24px, 3vw, 46px);
            }

            .admin-header {
                min-height: 64px;
                margin-bottom: 20px;
            }

            .header-path {
                font-size: 1rem;
            }

            .admin-profile {
                gap: 12px;
                font-size: 0.9rem;
            }

            .profile-avatar {
                width: 42px;
                height: 42px;
                font-size: 1rem;
            }

            .admin-panel {
                width: min(1280px, 100%);
            }

            .page-heading {
                margin-bottom: 20px;
            }

            .page-heading h2 {
                font-size: clamp(1.8rem, 2.4vw, 2.15rem);
            }

            .page-heading p {
                margin-top: 8px;
                font-size: 1rem;
            }

            .topbar {
                margin-bottom: 18px;
            }

            .toolbar {
                gap: 11px;
            }

            .search-box {
                width: min(250px, 24vw);
            }

            .search-box input,
            .filter-box select {
                height: 42px;
                font-size: 0.9rem;
            }

            .search-box .search-icon {
                width: 19px;
                height: 19px;
            }

            .filter-box {
                width: 130px;
            }

            .add-btn {
                min-height: 42px;
                padding-right: 17px;
                padding-left: 17px;
                font-size: 0.9rem;
            }

            .add-btn span {
                font-size: 1.35rem;
            }

            .stats {
                gap: 14px;
                margin-bottom: 18px;
            }

            .stat-card {
                min-height: 76px;
                padding: 13px 17px;
                border-radius: 12px;
            }

            .stat-card .label {
                font-size: 0.9rem;
            }

            .stat-card .value {
                font-size: 1.4rem;
            }

            .table-card {
                border-radius: 14px;
            }

            .table-card-heading {
                padding: 15px 19px;
            }

            .table-card-heading h3 {
                font-size: 1rem;
            }

            .table-card-heading p {
                font-size: 0.9rem;
            }

            thead th {
                padding: 13px 17px;
                font-size: 0.88rem;
            }

            tbody td {
                padding: 8px 13px;
                font-size: 0.92rem;
            }

            .inline-edit-input {
                padding: 9px 10px;
                font-size: 0.92rem;
            }

            .action-cell {
                width: 100px;
            }

            .delete-btn {
                width: 33px;
                height: 33px;
            }

            .delete-btn svg {
                width: 17px;
                height: 17px;
            }

            .pagination-wrap {
                gap: 9px;
                margin-top: 16px;
            }

            .pager-btn {
                min-width: 38px;
                height: 38px;
                font-size: 0.95rem;
            }

            #modalTambahSiswa .modal-dialog {
                max-width: 520px;
            }

            #modalTambahSiswa .modal-title {
                font-size: 1.28rem;
            }

            #modalTambahSiswa .modal-title::after {
                font-size: 0.9rem;
            }

            #modalTambahSiswa .form-label {
                font-size: 0.9rem;
            }

            #modalTambahSiswa .form-control {
                min-height: 48px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 640px) {
            .page-heading h2 {
                font-size: 1.65rem;
            }

            .page-heading p {
                font-size: 0.92rem;
            }

            .sidebar-link {
                min-height: 42px;
                font-size: 0.88rem;
            }

            .search-box input,
            .filter-box select,
            .add-btn {
                min-height: 40px;
                font-size: 0.85rem;
            }

            thead th {
                font-size: 0.78rem;
            }

            tbody td,
            .inline-edit-input {
                font-size: 0.84rem;
            }

            .stat-card .label {
                font-size: 0.85rem;
            }

            .stat-card .value {
                font-size: 1.35rem;
            }
        }
    </style>
</head>

<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <circle cx="32" cy="32" r="30" fill="#EAF6FF"/>
                        <path d="M32 8c-8 0-14 6-14 14v3h28v-3c0-8-6-14-14-14Zm-18 18h36v9c0 8-8 16-18 18-10-2-18-10-18-18v-9Zm25 6h-14v-4h14v4Zm-18 13h24v4H21v-4Zm3-9h18v4H24v-4Z" fill="#0E5DA5"/>
                        <circle cx="32" cy="32" r="2.5" fill="#0E5DA5"/>
                    </svg>
                </div>
                <div class="brand-text">
                    <h1>Admin Sekolah</h1>
                    <p>Sistem Data Siswa</p>
                </div>
            </div>
            <p class="sidebar-caption">Navigasi</p>
            <a class="sidebar-link active" href="<?= site_url('/') ?>" aria-current="page">
                <span class="sidebar-link-icon" aria-hidden="true">▦</span>
                <span>Dashboard</span>
            </a>
            <a class="sidebar-link" href="#daftar-siswa">
                <span class="sidebar-link-icon" aria-hidden="true">♧</span>
                <span>Daftar Siswa</span>
            </a>
            <button type="button" class="sidebar-link sidebar-action" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                <span class="sidebar-link-icon" aria-hidden="true">＋</span>
                <span>Tambah Siswa</span>
            </button>
        </aside>

        <main class="main-area">
            <div class="admin-header">
                <div class="header-path"><strong>Admin Utama</strong> <span aria-hidden="true">|</span> Dashboard Siswa XI RPL</div>
                <div class="admin-profile">
                    <span class="profile-avatar" aria-hidden="true">A</span>
                    <span>Admin Utama</span>
                </div>
            </div>

            <div class="admin-panel">
                <div class="page-heading">
                    <div>
                        <h2>Data Siswa XI RPL</h2>
                        <p>Ringkasan Data Siswa</p>
                    </div>
                </div>
                <div class="topbar">
                    <div class="toolbar">
                <form class="toolbar" method="get" action="<?= site_url('/') ?>" style="gap: 12px;">
                    <div class="search-box">
                        <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search..." aria-label="Search siswa">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="5.5" stroke="#718198" stroke-width="1.8"/>
                            <path d="M16 16L21 21" stroke="#718198" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="filter-box">
                        <select name="kelas" aria-label="Filter kelas" onchange="this.form.submit()">
                            <?php foreach (($filterOptions ?? ['Semua']) as $option) : ?>
                                <option value="<?= esc($option) ?>" <?= ($kelasSelected ?? 'Semua') === $option ? 'selected' : '' ?>><?= esc($option) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="add-btn" style="padding: 0 18px;">
                        <span>⌕</span> Cari
                    </button>
                </form>
                <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                    <span>+</span> Tambah Data Siswa
                </button>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card">
                <span class="label">Total Siwa:</span>
                <span class="value"><?= esc((string) ($totalSiswa ?? count($siswa ?? []))) ?></span>
            </div>
            <div class="stat-card">
                <span class="label">Kelas Tersedia:</span>
                <span class="value"><?= esc((string) max(0, count($filterOptions ?? []) - 1)) ?></span>
            </div>
            <div class="stat-card">
                <span class="label">Ditampilkan:</span>
                <span class="value"><?= esc((string) count($siswa ?? [])) ?></span>
            </div>
        </div>

        <section class="table-card" id="daftar-siswa">
            <div class="table-card-heading">
                <div>
                    <h3>Daftar Siswa</h3>
                    <p>Data siswa yang terdaftar dalam sistem</p>
                </div>
            </div>
        <div class="table-wrap">
            <table aria-label="Daftar siswa">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th style="width: 90px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($siswa)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($siswa as $row) : ?>
                            <tr data-siswa-row>
                                <td><?= $no++ ?></td>
                                <?php foreach (['nis' => $row['nis'], 'nama' => $row['nama'], 'kelas' => $row['kelas']] as $field => $value) : ?>
                                    <?php $value = is_scalar($value) ? (string) $value : ''; ?>
                                    <td>
                                        <form action="<?= site_url('siswa/update/' . $row['id']) ?>" method="post" class="inline-edit-form">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="page" value="<?= esc((string) $currentPage) ?>">
                                            <input
                                                type="text"
                                                name="<?= esc($field) ?>"
                                                value="<?= esc($value) ?>"
                                                class="inline-edit-input"
                                                aria-label="Klik untuk mengedit <?= esc($field) ?> <?= esc($row['nama']) ?>"
                                                title="Klik untuk mengedit; perubahan tersimpan saat fokus hilang"
                                                required
                                            >
                                        </form>
                                    </td>
                                <?php endforeach; ?>
                                <td class="action-cell">
                                    <form action="<?= site_url('siswa/delete/' . $row['id']) ?>" method="post" class="delete-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="page" value="<?= esc((string) $currentPage) ?>">
                                        <button type="submit" class="delete-btn" aria-label="Hapus siswa">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M5 7h14M9 7V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7m-7 0 1.2 10.7A1.5 1.5 0 0 0 10.7 19h2.6a1.5 1.5 0 0 0 1.5-1.3L16 7H8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (empty($siswa)) : ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 22px 16px; color: #78879a;">Belum ada data siswa di halaman ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        </section>

        <div class="pagination-wrap" aria-label="Navigasi halaman siswa">
            <?php
                $query = $_GET;
                $page = isset($currentPage) ? (int) $currentPage : 1;
                $totalPages = isset($totalPages) ? (int) $totalPages : 1;
                $prevPage = max(1, $page - 1);
                $nextPage = min($totalPages, $page + 1);
                $baseUrl = site_url('/');
            ?>
            <a class="pager-btn ghost <?= $page <= 1 ? 'disabled' : '' ?>" href="<?= $page <= 1 ? '#' : esc($baseUrl . '?' . http_build_query(array_merge($query, ['page' => $prevPage]))) ?>" aria-label="Halaman sebelumnya" <?= $page <= 1 ? 'aria-disabled="true" tabindex="-1"' : '' ?>>&lt;</a>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <?php
                    $params = $query;
                    $params['page'] = $i;
                ?>
                <a class="pager-btn <?= $i === $page ? 'active' : '' ?>" href="<?= esc($baseUrl . '?' . http_build_query($params)) ?>" <?= $i === $page ? 'aria-current="page"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>

            <a class="pager-btn ghost <?= $page >= $totalPages ? 'disabled' : '' ?>" href="<?= $page >= $totalPages ? '#' : esc($baseUrl . '?' . http_build_query(array_merge($query, ['page' => $nextPage]))) ?>" aria-label="Halaman berikutnya" <?= $page >= $totalPages ? 'aria-disabled="true" tabindex="-1"' : '' ?>>&gt;</a>
        </div>
    </div>
        </main>
    </div>

    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 18px;">
                <form action="<?= site_url('siswa/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="page" value="<?= esc((string) $currentPage) ?>">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="modalTambahSiswaLabel">Tambah Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.inline-edit-input').forEach((input) => {
            const form = input.form;
            const originalValue = input.value;
            let submitting = false;

            function saveIfChanged() {
                if (submitting || input.value === originalValue) {
                    return;
                }

                if (input.value.trim() === '') {
                    input.value = originalValue;
                    return;
                }

                submitting = true;
                form.requestSubmit();
            }

            input.addEventListener('blur', saveIfChanged);
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    saveIfChanged();
                }
                if (event.key === 'Escape') {
                    input.value = originalValue;
                    input.blur();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            const searchInput = document.querySelector('input[name="search"]');
            const kelasSelect = document.querySelector('select[name="kelas"]');

            if (searchInput && params.has('search')) {
                searchInput.value = params.get('search');
            }

            if (kelasSelect && params.has('kelas')) {
                const selected = params.get('kelas');
                Array.from(kelasSelect.options).forEach((option) => {
                    if (option.value === selected) {
                        option.selected = true;
                    }
                });
            }
        });
    </script>
</body>

</html>