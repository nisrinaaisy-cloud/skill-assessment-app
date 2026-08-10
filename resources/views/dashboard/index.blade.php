@extends('layouts.app')

@section('content')

<style>
    .dashboard-skill {
        --primary: #4B49AC;
        --primary-dark: #343178;
        --primary-soft: #F3F2FF;
        --secondary: #98BDFF;
        --secondary-strong: #7DA0FA;
        --support-purple: #7978E9;
        --support-pink: #F3797E;
        --pink-soft: #FDEEEF;
        --text: #13233E;
        --muted: #65738F;
        --border: #E5EAF7;
        --surface: rgba(255,255,255,.88);
        --surface-solid: #FFFFFF;
        --soft-bg: #F4F6FF;

        min-height: 100vh;
        padding: 20px 26px 24px;
        color: var(--text);
        background:
            linear-gradient(135deg, #F2F4FF 0%, #F5F4FF 46%, #F7F7FC 100%);
        box-shadow: inset 0 0 0 1px rgba(229,234,247,.62);
    }

    .dashboard-skill * {
        box-sizing: border-box;
    }

    .dashboard-skill .section-space {
        margin-bottom: 16px;
    }

    .dashboard-skill .card-shell {
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(213, 220, 242, .88);
        border-radius: 18px;
        box-shadow: 0 14px 30px rgba(52, 49, 120, .065);
        backdrop-filter: blur(8px);
    }

    .dashboard-skill .panel-head {
        min-height: 48px;
        padding: 0 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        color: #24305F;
        background: transparent;
        border-bottom: 1px solid rgba(229, 234, 247, .9);
        font-size: 13px;
        font-weight: 950;
        letter-spacing: .1px;
        text-transform: uppercase;
    }

    .dashboard-skill .panel-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #2436B1;
        min-width: 0;
        line-height: 1.18;
    }

    .dashboard-skill .panel-title i {
        color: var(--primary);
        font-size: 17px;
    }

    .dashboard-skill .panel-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 10px;
        background: #F1F0FF;
        color: var(--primary);
        font-size: 11px;
        font-weight: 950;
        white-space: nowrap;
        text-transform: none;
    }

    .executive-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 16px;
    }

    .executive-card {
        position: relative;
        overflow: hidden;
        min-height: 112px;
        padding: 18px 20px;
        border-radius: 18px;
        border: 1px solid rgba(213, 220, 242, .9);
        background:
            radial-gradient(circle at 95% 12%, rgba(152, 189, 255, .22), transparent 34%),
            linear-gradient(135deg, rgba(255,255,255,.94), rgba(249,250,255,.90));
        box-shadow: 0 14px 30px rgba(52, 49, 120, .07);
    }

    .executive-card.featured {
        background:
            radial-gradient(circle at 96% 0%, rgba(152, 189, 255, .32), transparent 34%),
            linear-gradient(135deg, var(--primary), var(--support-purple));
        color: #fff;
    }

    .executive-icon {
        width: 44px;
        height: 44px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        float: left;
        margin-right: 14px;
        background: linear-gradient(135deg, var(--primary), var(--secondary-strong));
        color: #fff;
        font-size: 21px;
        box-shadow: 0 10px 20px rgba(75,73,172,.20);
    }

    .executive-icon.pink {
        background: linear-gradient(135deg, var(--support-pink), #FB8C9B);
    }

    .executive-title {
        font-size: 12px;
        font-weight: 950;
        color: #566585;
        text-transform: uppercase;
        letter-spacing: .35px;
        line-height: 1.15;
    }

    .executive-value {
        margin-top: 9px;
        font-size: 31px;
        line-height: 1;
        font-weight: 950;
        color: #111B45;
    }

    .executive-sub {
        margin-top: 7px;
        font-size: 12px;
        font-weight: 800;
        color: #62708E;
    }

    .executive-trend {
        position: absolute;
        right: 18px;
        bottom: 18px;
        font-size: 11px;
        font-weight: 950;
        color: #18B76A;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .executive-trend.warn { color: var(--support-pink); }

    .workflow-card {
        padding: 0 12px 12px;
    }

    .workflow-card .panel-head {
        padding-left: 2px;
        padding-right: 2px;
        border-bottom: none;
        min-height: 40px;
    }

    .workflow-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .workflow-item {
        min-height: 108px;
        padding: 15px 16px;
        border-radius: 16px;
        display: grid;
        grid-template-columns: 70px 1fr;
        align-items: center;
        gap: 14px;
        border: 1px solid #E6EBFA;
        background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFF 100%);
    }

    .workflow-icon {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .workflow-icon.warn { background: #FFF1F3; color: var(--support-pink); }
    .workflow-icon.review { background: #EFF5FF; color: var(--secondary-strong); }
    .workflow-icon.approval { background: var(--primary-soft); color: var(--primary); }

    .workflow-number {
        font-size: 30px;
        line-height: 1;
        font-weight: 950;
        color: var(--primary);
    }

    .workflow-item.warn .workflow-number { color: var(--support-pink); }
    .workflow-item.review .workflow-number { color: var(--secondary-strong); }

    .workflow-name {
        margin-top: 7px;
        font-size: 12px;
        font-weight: 950;
        color: #142341;
    }

    .mini-progress {
        margin-top: 10px;
        height: 5px;
        border-radius: 999px;
        overflow: hidden;
        background: #EBEEF8;
    }

    .mini-fill {
        height: 100%;
        border-radius: 999px;
        background: var(--primary);
    }

    .mini-fill.warn { background: var(--support-pink); }
    .mini-fill.review { background: var(--secondary-strong); }

    .mini-percent {
        margin-top: 6px;
        font-size: 11px;
        font-weight: 800;
        color: #65738F;
    }

    .mid-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 16px;
        align-items: stretch;
    }

    .mid-card{
        display:flex;
        flex-direction:column;
        align-self:stretch;
        height:100%;
    }

    .mid-grid > .mid-card:nth-child(1),
    .mid-grid > .mid-card:nth-child(2),
    .mid-grid > .mid-card:nth-child(3) {
        grid-column: span 2;
    }

    .mid-grid > .mid-card:nth-child(4),
    .mid-grid > .mid-card:nth-child(5) {
        grid-column: span 3;
        min-height: 242px;
    }

    .mid-card .panel-head {
        flex: 0 0 auto;
    }

    .mid-card .see-all-link {
        margin-top: auto;
    }

    .priority-list {
        padding: 12px;
    }

    .priority-row {
        display: grid;
        grid-template-columns: 44px 1fr auto;
        align-items: center;
        gap: 12px;
        min-height: 58px;
        padding: 10px;
        border-radius: 14px;
        text-decoration: none;
        color: var(--text);
        border: 1px solid #E8EDFA;
        background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFF 100%);
    }

    .priority-row + .priority-row { margin-top: 9px; }
    .priority-row:hover { color: var(--text); box-shadow: 0 10px 22px rgba(75,73,172,.10); transform: translateY(-1px); }

    .priority-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: linear-gradient(135deg, var(--primary), var(--support-purple));
        font-size: 18px;
    }

    .priority-icon.info { background: linear-gradient(135deg, var(--secondary-strong), var(--primary)); }
    .priority-icon.warn { background: linear-gradient(135deg, var(--support-pink), #FF8191); }

    .priority-title {
        font-size: 12px;
        font-weight: 950;
        color: #142341;
    }

    .priority-sub {
        margin-top: 3px;
        font-size: 10px;
        font-weight: 800;
        color: var(--muted);
    }

    .priority-count {
        min-width: 34px;
        text-align: right;
        font-size: 22px;
        line-height: 1;
        font-weight: 950;
        color: var(--primary);
    }

    .priority-row.warn .priority-count { color: var(--support-pink); }

    .quality-body {
        padding: 14px;
        display: grid;
        grid-template-columns: 132px 1fr;
        gap: 14px;
        align-items: center;
        min-height: 209px;
    }

    .quality-circle {
        width: 132px;
        height: 132px;
        border-radius: 50%;
        background: conic-gradient(var(--primary) 0 calc(var(--rate) * 1%), var(--support-pink) calc(var(--rate) * 1%) 100%);
        position: relative;
    }

    .quality-circle::after {
        content: "";
        position: absolute;
        inset: 27px;
        border-radius: 50%;
        background: #fff;
        box-shadow: inset 0 0 0 1px rgba(75,73,172,.07);
    }

    .quality-center {
        position: absolute;
        inset: 0;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .quality-rate {
        font-size: 24px;
        font-weight: 950;
        color: var(--primary);
        line-height: 1;
    }

    .quality-label {
        margin-top: 6px;
        font-size: 10px;
        font-weight: 850;
        color: var(--muted);
    }

    .quality-stat {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 10px;
        padding: 9px 0;
        border-bottom: 1px solid #EEF2FF;
        font-size: 11px;
        font-weight: 900;
        color: var(--muted);
    }

    .quality-stat:last-child { border-bottom: none; }
    .quality-stat b { color: #13233E; }

    .rank-list {
        padding: 13px 12px 8px;
        flex: 1 1 auto;
    }

    .rank-item {
        display: grid;
        grid-template-columns: 28px 1fr 38px;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
    }

    .rank-no {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--support-purple));
        color: #fff;
        font-size: 12px;
        font-weight: 950;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rank-title {
        font-size: 11px;
        font-weight: 950;
        color: #13233E;
        line-height: 1.15;
        text-transform: uppercase;
        max-width: 132px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rank-sub {
        margin-top: 3px;
        font-size: 9px;
        color: var(--muted);
        font-weight: 800;
        letter-spacing: .2px;
    }

    .rank-value {
        min-width: 32px;
        padding: 5px 8px;
        border-radius: 999px;
        background: #EEF4FF;
        color: var(--primary);
        text-align: center;
        font-size: 11px;
        font-weight: 950;
    }

    .see-all-link {
        display: block;
        margin-top: auto;
        padding: 8px 16px 16px;
        font-size: 11px;
        font-weight: 950;
        color: var(--primary);
        text-align: right;
        text-decoration: none;
    }

    .area-list{
        padding:17px 18px 8px;
        flex:1;
        overflow-y:auto;
    }

    .area-item + .area-item { margin-top: 18px; }

    .area-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 9px;
        font-size: 12px;
        font-weight: 950;
        color: #13233E;
        text-transform: uppercase;
        letter-spacing: .15px;
        line-height: 1.1;
    }

    .area-top span:first-child {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: 4px;
    }

    .area-top span:last-child {
        flex: 0 0 auto;
    }

    .area-bar {
        height: 8px;
        border-radius: 999px;
        background: #ECEFF8;
        overflow: hidden;
    }

    .area-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--primary), var(--support-purple));
    }

.part-rank-toolbar {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.part-rank-filter-box {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px;
    border-radius: 13px;
    background: rgba(244, 243, 255, .86);
    border: 1px solid #E3E8F8;
}

.part-rank-filter-label {
    display: none;
}

.part-rank-filter-form {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.part-rank-select {
    height: 36px;
    min-width: 210px;
    border: 1px solid #DCE4F7;
    border-radius: 11px;
    background: #fff;
    color: var(--text);
    font-size: 11px;
    font-weight: 900;
    padding: 0 12px;
    outline: none;
    box-shadow: none;
}

.part-rank-select:last-child {
    min-width: 150px;
}

.part-rank-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 .15rem rgba(75, 73, 172, .10);
}

@media (max-width: 1400px) {
    .part-rank-toolbar {
        align-items: flex-start;
        flex-direction: column;
    }

    .part-rank-filter-box {
        width: 100%;
    }

    .part-rank-filter-form {
        width: 100%;
    }

    .part-rank-select {
        width: 100%;
        min-width: 0;
    }

    .part-rank-select:last-child {
        min-width: 0;
    }
}

.area-sub {
    margin-top: -4px;
    margin-bottom: 8px;
    font-size: 9.7px;
    font-weight: 800;
    color: var(--muted);
    line-height: 1.35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.area-value {
    min-width: 78px;
    text-align: right;
    font-size: 11px;
    font-weight: 950;
    color: var(--primary);
    white-space: nowrap;
    text-transform: none;
}

.area-empty {
    padding: 28px 14px;
    border-radius: 14px;
    background: #F8FAFF;
    color: var(--muted);
    font-size: 12px;
    font-weight: 850;
    text-align: center;
}

@media (max-width: 1200px) {
    .part-rank-toolbar {
        align-items: flex-start;
        flex-direction: column;
    }

    .part-rank-filter-box {
        width: 100%;
        align-items: flex-start;
        flex-direction: column;
    }

    .part-rank-filter-form {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }

    .part-rank-select {
        width: 100%;
        min-width: 100%;
    }
}

    .target-dropdown { position: relative; }

    .target-select-btn {
        min-width: 104px;
        height: 32px;
        padding: 0 10px;
        border: none;
        border-radius: 9px;
        background: #F4F3FF;
        color: var(--text);
        font-size: 11px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 9px;
    }

    .target-dropdown .dropdown-menu {
        width: 210px;
        max-height: 240px;
        overflow-y: auto;
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 20px 34px rgba(24,32,74,.18);
        z-index: 9999;
        padding: 6px;
    }

    .target-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 9px 10px;
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }

    .target-dropdown .dropdown-item.active,
    .target-dropdown .dropdown-item:active {
        background: var(--primary);
        color: #fff;
    }

    .target-list{
        display:flex;
        flex-direction:column;
        flex:1;
        overflow-y:auto;
    }

    .target-row {
        padding: 9px 0 11px;
        border-bottom: 1px solid #EEF2FF;
    }

    .target-top {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto auto;
        gap: 7px;
        align-items: center;
        margin-bottom: 7px;
        width: 100%;
        min-width: 0;
    }

    .target-name {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 950;
        color: #13233E;
    }

    .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--support-purple);
    }

    .target-pill {
        padding: 5px 9px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 950;
        white-space: nowrap;
    }

    .target-success { background: #EAF8F0; color: #13A15A; }
    .target-info { background: var(--primary-soft); color: var(--support-purple); }
    .target-warning { background: #FFF6E6; color: #D98A00; }
    .target-danger { background: var(--pink-soft); color: #F05D6D; }

    .target-value {
        font-size: 11px;
        font-weight: 950;
        color: #13233E;
        white-space: nowrap;
    }

    .progress-track {
        height: 5px;
        background: #EDF1FA;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 999px;
    }

    .fill-success { background: linear-gradient(90deg, #57D68D, #13A15A); }
    .fill-info { background: linear-gradient(90deg, var(--secondary-strong), var(--support-purple)); }
    .fill-warning { background: linear-gradient(90deg, #FFC56A, #E89A00); }
    .fill-danger { background: linear-gradient(90deg, #F5A1AA, var(--support-pink)); }

    .target-percent {
        margin-top: 4px;
        text-align: right;
        font-size: 10px;
        font-weight: 950;
        color: var(--muted);
    }

    .target-summary {
        padding: 8px 13px 12px;
        font-size: 11px;
        font-weight: 900;
        color: var(--primary);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top:auto;
    }

    .target-summary span:last-child { color: var(--support-pink); }

    .insight-chart-grid {
        display: grid;
        grid-template-columns: .78fr 1.22fr;
        gap: 12px;
        margin-bottom: 16px;
        align-items: stretch;
    }

    .insight-body {
        padding: 16px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .insight-mini {
        min-height: 118px;
        padding: 14px;
        border-radius: 14px;
        border: 1px solid #E8EDFA;
        background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFF 100%);
        display: grid;
        grid-template-columns: 1fr 48px;
        grid-template-rows: auto 1fr auto;
        column-gap: 12px;
        align-items: center;
    }

    .insight-label {
        grid-column: 1 / 2;
        font-size: 9px;
        font-weight: 950;
        color: #64728F;
        text-transform: uppercase;
        letter-spacing: .25px;
        line-height: 1.2;
        min-height: 22px;
        display: flex;
        align-items: flex-start;
    }

    .insight-title {
        grid-column: 1 / 2;
        margin-top: 8px;
        font-size: 15px;
        font-weight: 950;
        color: #13233E;
        line-height: 1.15;
        text-transform: none;
    }

    .insight-sub {
        grid-column: 1 / 2;
        margin-top: 8px;
        font-size: 11px;
        font-weight: 800;
        color: var(--muted);
        line-height: 1.25;
    }

    .insight-circle {
        grid-column: 2 / 3;
        grid-row: 1 / 4;
        align-self: center;
        justify-self: end;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F3F2FF;
        color: var(--primary);
        font-size: 21px;
        margin: 0;
    }

    .chart-card {
        overflow: hidden;
    }

    .chart-card .panel-head {
        min-height: 45px;
    }

    .chart-wrap {
        padding: 12px 16px 10px;
    }

    .chart-legend {
        display: flex;
        justify-content: flex-end;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 3px;
        font-size: 10px;
        font-weight: 850;
        color: var(--muted);
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .legend-box {
        width: 10px;
        height: 10px;
        border-radius: 4px;
    }

    .legend-line {
        width: 18px;
        height: 0;
        border-top: 2px solid;
        border-radius: 2px;
    }

    .legend-line.dashed { border-top-style: dashed; }

    .table-card {
        overflow: hidden;
        background: rgba(255,255,255,.91);
    }

    .table-card .panel-head {
        min-height: 47px;
        border-bottom: 1px solid #EEF2FF;
    }

    .capped-body {
        padding: 12px 14px 14px;
    }

    .table-filter {
        padding: 12px;
        border-radius: 14px;
        background: #F8FAFF;
        border: 1px solid #E6EBFA;
        margin-bottom: 12px;
    }

    .filter-label {
        display: block;
        font-size: 10px;
        font-weight: 950;
        color: #65738F;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 7px;
    }

    .filter-input {
        height: 43px;
        border-radius: 12px;
        border: 1px solid #D7DFF2;
        font-size: 12px;
        font-weight: 850;
        color: var(--text);
        background-color: #fff;
    }

    .assessment-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .assessment-table thead th {
        font-size: 10px;
        color: #566585;
        font-weight: 950;
        text-transform: uppercase;
        border: none;
        background: #F0F3FF;
        padding: 11px 10px;
        text-align: center;
        white-space: nowrap;
    }

    .assessment-table tbody td {
        border: none;
        border-bottom: 1px solid #EEF2FF;
        padding: 12px 10px;
        font-size: 11px;
        font-weight: 700;
        vertical-align: middle;
        text-align: center;
        color: #18233C;
    }

    .assessment-table .text-start {
        text-align: left !important;
    }

    .operator-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .operator-avatar {
        flex: 0 0 28px;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--support-purple));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 950;
    }

    .operator-name {
        font-size: 11px;
        font-weight: 950;
        color: #13233E;
        text-transform: uppercase;
        line-height: 1.1;
    }

    .operator-nik {
        font-size: 9px;
        color: #6D7A96;
        margin-top: 3px;
        font-weight: 800;
    }

    .status-pill {
        display: inline-flex;
        min-width: 104px;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 950;
    }

    .status-lulus { background: #DCF8E7; color: #15A35D; }
    .status-tidak_lulus { background: var(--pink-soft); color: #F05D6D; }
    .status-submitted { background: #FFF2DA; color: #E18B00; }
    .status-dinilai { background: #F1EEFF; color: var(--support-purple); }

    .btn-eye {
        width: 30px;
        height: 30px;
        border-radius: 10px;
        border: 1px solid #CCD7FF;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background: #fff;
        font-size: 12px;
    }

    .btn-eye:hover {
        background: var(--primary);
        color: #fff;
    }

    .table-footer {
        margin-top: 12px;
        padding: 11px 13px;
        border-radius: 14px;
        background: #f8faff;
        border: 1px solid #eef2ff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .pagination svg {
        width: 15px !important;
        height: 15px !important;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        border: none;
        margin: 0 3px;
        border-radius: 8px;
        color: var(--primary);
        font-weight: 700;
        background: #eef2ff;
    }

    .pagination .page-link:hover {
        background: #dbe4ff;
        color: var(--primary);
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, var(--primary), var(--secondary-strong));
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.25);
    }

    .pagination .page-link:focus {
        box-shadow: none;
    }

    .empty-state {
        padding: 24px 16px;
        border-radius: 14px;
        background: #F8FAFF;
        color: var(--muted);
        font-weight: 850;
    }

    #monitoring-assessment {
        scroll-margin-top: 110px;
    }

    @media (max-width: 1400px) {
    .mid-grid{
        display:grid;
        grid-template-columns:repeat(6,minmax(0,1fr));
        gap:12px;
        margin-bottom:16px;
        align-items:stretch;
    }

        .mid-grid > .mid-card:nth-child(1),
        .mid-grid > .mid-card:nth-child(2),
        .mid-grid > .mid-card:nth-child(3),
        .mid-grid > .mid-card:nth-child(4),
        .mid-grid > .mid-card:nth-child(5) {
            grid-column: span 3;
        }

        .insight-chart-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1200px) {
        .executive-strip,
        .workflow-grid,
        .mid-grid,
        .insight-body {
            grid-template-columns: 1fr;
        }

        .quality-body {
            grid-template-columns: 1fr;
            justify-items: center;
        }
    }

        /* ===== FIX BACKGROUND BIAR NYATU ===== */

        body,
        .content-wrapper,
        .main-panel,
        .page-body-wrapper,
        .container-scroller {
            background: #eef2ff !important;
        }

        .dashboard-skill {
            padding: 22px 28px 28px !important;
            border-radius: 0 !important;
            background:
                radial-gradient(circle at 18% 8%, rgba(152,189,255,.20), transparent 28%),
                radial-gradient(circle at 88% 18%, rgba(121,120,233,.16), transparent 32%),
                linear-gradient(135deg, #eef2ff 0%, #f1f3ff 46%, #eef1fb 100%) !important;
            box-shadow: none !important;
        }

        /* biar tidak ada kotak biru muda yang terlalu menonjol */
        .dashboard-skill::before,
        .dashboard-skill::after {
            display: none !important;
        }

        /* samakan tone semua card */
        .dashboard-skill .card-shell,
        .dashboard-skill .executive-card,
        .dashboard-skill .workflow-hero {
            background:
                linear-gradient(145deg, rgba(255,255,255,.88), rgba(248,250,255,.82)) !important;
            border: 1px solid rgba(197, 208, 238, .82) !important;
            box-shadow: 0 12px 28px rgba(75, 73, 172, .075) !important;
        }

        /* area dalam card jangan terlalu putih polos */
        .dashboard-skill .capped-body,
        .dashboard-skill .workflow-body,
        .dashboard-skill .quality-panel,
        .dashboard-skill .rank-list,
        .dashboard-skill .target-list,
        .dashboard-skill .action-list,
        .dashboard-skill .chart-wrap {
            background: transparent !important;
        }

        /* hilangkan efek putih terlalu tajam */
        .dashboard-skill .action-row,
        .dashboard-skill .workflow-item,
        .dashboard-skill .quality-meter,
        .dashboard-skill .insight-mini-card,
        .dashboard-skill .assessment-table tbody tr {
            background:
                linear-gradient(145deg, rgba(255,255,255,.78), rgba(248,250,255,.72)) !important;
        }

        /* panel header tetap soft tapi menyatu */
        .dashboard-skill .panel-head {
            background:
                linear-gradient(90deg, rgba(75,73,172,.10), rgba(121,120,233,.08), rgba(243,121,126,.08)) !important;
            color: #233b9f !important;
            border-bottom: 1px solid rgba(213,220,242,.9) !important;
        }

        /* badge tidak terlalu nempel warna putih */
        .dashboard-skill .panel-badge,
        .dashboard-skill .target-select-btn {
            background: rgba(243,242,255,.86) !important;
            color: #4B49AC !important;
        }

        /* background tabel biar ikut nyatu */
        .table-filter {
            background:
                linear-gradient(145deg, rgba(248,250,255,.78), rgba(241,243,255,.72)) !important;
        }

        /* ===== FIX AREA ATAS BIAR NYATU DENGAN SECTION LAIN ===== */

       /* ===== FIX KPI ATAS: JANGAN DOUBLE CARD ===== */

        .executive-strip {
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        .dashboard-skill {
            background:
                linear-gradient(135deg, #eef2ff 0%, #f3f4ff 45%, #eef1fb 100%) !important;
        }

        .executive-card {
            background:
                linear-gradient(145deg, rgba(255,255,255,.92), rgba(247,249,255,.88)) !important;
        }

        .executive-card {
            background:
                linear-gradient(145deg, rgba(255,255,255,.90), rgba(248,250,255,.86)) !important;
            box-shadow: 0 10px 24px rgba(75,73,172,.07) !important;
        }

        /* jarak antara card atas dan workflow jadi lebih rapi */
        .executive-strip + .workflow-card {
            margin-top: 0 !important;
        }

        /* ===== FIX HEADER WORKFLOW BIAR SAMA DENGAN CARD LAIN ===== */

        .workflow-card {
            padding: 0 !important;
            overflow: hidden !important;
        }

        .workflow-card .panel-head {
            min-height: 48px !important;
            padding: 0 16px !important;
            border-bottom: 1px solid rgba(213,220,242,.9) !important;
            background:
                linear-gradient(90deg, rgba(75,73,172,.10), rgba(121,120,233,.08), rgba(243,121,126,.08)) !important;
            border-radius: 18px 18px 0 0 !important;
        }

        .workflow-grid {
            padding: 12px !important;
        }

        .card-shell,
        .chart-card,
        .workflow-card,
        .table-card,
        .insight-card {
            overflow: hidden !important;
        }
        .target-summary{
            margin-top:auto;
            padding:14px 18px;
            border-top:1px solid #eef2ff;
        }
        .target-card{
            display:flex;
            flex-direction:column;
        }

        .target-card .panel-head{
            flex:0 0 auto;
        }

        .target-list{
            display:flex;
            flex-direction:column;
            flex:1 1 auto;
            min-height:0;
            min-width:0;
            width:100%;
            overflow-y:auto;
            overflow-x:hidden;
        }

        .target-card .target-summary{
            flex:0 0 auto;
            margin-top:auto;
        }
        /* ===== FIX CARD PENCAPAIAN TARGET ===== */
        .target-card{
            min-width:0 !important;
            width:100% !important;
            overflow:hidden !important;
        }

        .target-card .panel-head{
            min-width:0;
            width:100%;
            overflow:hidden;
        }

        .target-card .panel-title{
            min-width:0;
            white-space:nowrap;
        }

        .target-card .target-dropdown{
            flex:0 0 auto;
        }

        .target-card .target-list{
            width:100%;
            min-width:0;
            padding:0 14px !important;
            overflow-y:auto;
            overflow-x:hidden;
        }

        .target-card .target-row{
            width:100%;
            min-width:0;
            padding:10px 4px 11px;
        }

        .target-card .target-top{
            width:100%;
            min-width:0;
            display:grid;
            grid-template-columns:minmax(0,1fr) auto auto;
            gap:7px;
            align-items:center;
        }

        .target-card .target-name{
            min-width:0;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }

        .target-card .target-pill{
            max-width:110px;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .target-card .target-value{
            min-width:48px;
            text-align:right;
            white-space:nowrap;
            font-size:10px;
        }

        .target-card .progress-track{
            width:100%;
            min-width:0;
        }

        .target-card .target-percent{
            width:100%;
            padding-right:2px;
        }

        .target-card .target-summary{
            width:100%;
            min-width:0;
            padding:12px 18px !important;
            overflow:hidden;
        }

        .target-card .target-summary span{
            min-width:0;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .target-card .target-summary span:last-child{
            flex:0 0 auto;
        }
</style>

<div class="dashboard-skill">

    @php
        $openTask = ($totalBelumMengisi ?? 0) + ($totalMenungguPenilaian ?? 0) + ($totalMenungguApproval ?? 0);

        $targetAchieved = collect($targetCategoryRows)->where('percent', '>=', 100)->count();
        $targetProgress = collect($targetCategoryRows)->where('percent', '>', 0)->where('percent', '<', 100)->count();

        $topDivision = collect($topCategories)->sortByDesc('total')->first();
        $lowestTarget = collect($targetCategoryRows)->sortBy('percent')->first();
        $mostActiveOperator = collect($topOperators)->first();

        $mostActiveLeader = \App\Models\Assessment::query()
            ->join('operators', 'assessments.operator_id', '=', 'operators.id')
            ->join('users', 'operators.leader_id', '=', 'users.id')
            ->select('users.name', \Illuminate\Support\Facades\DB::raw('COUNT(*) as total_assessment'))
            ->whereIn('assessments.status', ['submitted', 'dinilai', 'lulus', 'tidak_lulus'])
            ->whereYear('assessments.created_at', now()->year)
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_assessment')
            ->first();

        $maxAreaTotal = max(collect($topCategories)->max('total') ?? 0, 1);
        $workflowBase = max($openTask, 1);
    @endphp

    <div class="executive-strip">
        <div class="executive-card">
            <div class="executive-icon"><i class="bi bi-people"></i></div>
            <div class="executive-title">Operator Aktif</div>
            <div class="executive-value">{{ $totalOperator }}</div>
            <div class="executive-sub">Aktif terdaftar</div>
            <div class="executive-trend"><i class="bi bi-arrow-up-short"></i> total</div>
        </div>

        <div class="executive-card">
            <div class="executive-icon"><i class="bi bi-lightning-charge"></i></div>
            <div class="executive-title">Open Task</div>
            <div class="executive-value">{{ $openTask }}</div>
            <div class="executive-sub">Perlu tindak lanjut</div>
            <div class="executive-trend warn"><i class="bi bi-arrow-up-short"></i> aktif</div>
        </div>

        <div class="executive-card">
            <div class="executive-icon pink"><i class="bi bi-award"></i></div>
            <div class="executive-title">Pass Rate</div>
            <div class="executive-value">{{ $passRate }}%</div>
            <div class="executive-sub">{{ $assessmentSelesai }} selesai</div>
            <div class="executive-trend"><i class="bi bi-arrow-up-short"></i> berjalan</div>
        </div>

        <div class="executive-card">
            <div class="executive-icon"><i class="bi bi-clipboard-check"></i></div>
            <div class="executive-title">Assessment Masuk {{ now()->year }}</div>
            <div class="executive-value">{{ $totalAssessment }}</div>
            <div class="executive-sub">Submitted, dinilai, lulus, & tidak lulus</div>
            <div class="executive-trend">total</div>
        </div>
    </div>

    <div class="card-shell workflow-card section-space">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-diagram-3"></i>
                Monitoring Workflow Assessment
            </div>

            <span class="panel-badge">
                <i class="bi bi-bell"></i>
                Smart Alert
            </span>
        </div>

        <div class="workflow-grid">
            <div class="workflow-item warn">
                <div class="workflow-icon warn">
                    <i class="bi bi-person-x"></i>
                </div>

                <div>
                    <div class="workflow-number">{{ $totalBelumMengisi }}</div>
                    <div class="workflow-name">Operator Belum Mengisi</div>
                    <div class="mini-progress">
                        <div class="mini-fill warn" style="width: {{ min(($totalBelumMengisi / $workflowBase) * 100, 100) }}%"></div>
                    </div>
                    <div class="mini-percent">{{ round(($totalBelumMengisi / $workflowBase) * 100, 1) }}% dari total</div>
                </div>
            </div>

            <div class="workflow-item review">
                <div class="workflow-icon review">
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div>
                    <div class="workflow-number">{{ $totalMenungguPenilaian }}</div>
                    <div class="workflow-name">Menunggu Penilaian</div>
                    <div class="mini-progress">
                        <div class="mini-fill review" style="width: {{ min(($totalMenungguPenilaian / $workflowBase) * 100, 100) }}%"></div>
                    </div>
                    <div class="mini-percent">{{ round(($totalMenungguPenilaian / $workflowBase) * 100, 1) }}% dari total</div>
                </div>
            </div>

            <div class="workflow-item approval">
                <div class="workflow-icon approval">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <div class="workflow-number">{{ $totalMenungguApproval }}</div>
                    <div class="workflow-name">
                        @if(auth()->user()->role == 'foreman')
                            Menunggu Approval Foreman
                        @elseif(auth()->user()->role == 'kabag')
                            Menunggu Approval Kabag
                        @else
                            Menunggu Approval
                        @endif
                    </div>
                    <div class="mini-progress">
                        <div class="mini-fill" style="width: {{ min(($totalMenungguApproval / $workflowBase) * 100, 100) }}%"></div>
                    </div>
                    <div class="mini-percent">{{ round(($totalMenungguApproval / $workflowBase) * 100, 1) }}% dari total</div>
                </div>
            </div>
        </div>
    </div>

<div class="mid-grid section-space">
    <div class="card-shell mid-card">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-command"></i>
                Priority Action Center
            </div>
            <span class="panel-badge">Direct</span>
        </div>

        <div class="priority-list">
            <a class="priority-row" href="{{ route('dashboard', array_merge(request()->except('status'), ['status' => 'submitted'])) }}">
                <div class="priority-icon info">
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div>
                    <div class="priority-title">Assessment perlu dinilai</div>
                    <div class="priority-sub">Masuk ke antrian leader</div>
                </div>

                <div class="priority-count">{{ $totalMenungguPenilaian }}</div>
            </a>

            <a class="priority-row" href="{{ route('dashboard', array_merge(request()->except('status'), ['status' => 'dinilai'])) }}#monitoring-assessment">
                <div class="priority-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <div class="priority-title">Assessment perlu approval</div>
                    <div class="priority-sub">
                        @if(auth()->user()->role == 'foreman')
                            Khusus antrian foreman
                        @elseif(auth()->user()->role == 'kabag')
                            Sudah disetujui foreman
                        @else
                            Foreman/Kabag
                        @endif
                    </div>
                </div>

                <div class="priority-count">{{ $totalMenungguApproval }}</div>
            </a>

            <a class="priority-row warn" href="#monitoring-assessment">
                <div class="priority-icon warn">
                    <i class="bi bi-person-x"></i>
                </div>

                <div>
                    <div class="priority-title">Operator belum mengisi</div>
                    <div class="priority-sub">Prioritas follow-up periode aktif</div>
                </div>

                <div class="priority-count">{{ $totalBelumMengisi }}</div>
            </a>
        </div>
    </div>

    <div class="card-shell mid-card">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-pie-chart"></i>
                Quality Snapshot
            </div>
            <span class="panel-badge">{{ now()->year }}</span>
        </div>

        <div class="quality-body">
            <div class="quality-circle" style="--rate: {{ $passRate }}">
                <div class="quality-center">
                    <div class="quality-rate">{{ $passRate }}%</div>
                    <div class="quality-label">Pass Rate</div>
                </div>
            </div>

            <div>
                <div class="quality-stat">
                    <span>Total Assessment</span>
                    <b>{{ $totalAssessment }}</b>
                </div>

                <div class="quality-stat">
                    <span>Selesai Dinilai</span>
                    <b>{{ $assessmentSelesai }}</b>
                </div>

                <div class="quality-stat">
                    <span>Open Task</span>
                    <b>{{ $openTask }}</b>
                </div>

                <div class="quality-stat">
                    <span>Belum Mengisi</span>
                    <b>{{ $totalBelumMengisi }}</b>
                </div>
            </div>
        </div>
    </div>

    <div class="card-shell mid-card">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-trophy"></i>
                Top 5 Operator {{ now()->year }}
            </div>
        </div>

        <div class="rank-list">
            @forelse($topOperators as $row)
                <div class="rank-item">
                    <div class="rank-no">{{ $loop->iteration }}</div>

                    <div>
                        <div class="rank-title">{{ $row->operator->nama_lengkap
                             ?? '-' }}</div>
                        <div class="rank-sub">{{ $row->operator->nik ?? '-' }}</div>
                    </div>

                    <div class="rank-value">{{ $row->total_assessment }}</div>
                </div>
            @empty
                <div class="text-muted small px-2 py-3">Belum ada data.</div>
            @endforelse
        </div>

        <a href="#monitoring-assessment" class="see-all-link">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="card-shell mid-card">
        <div class="panel-head">
            <div class="part-rank-toolbar">
                <div class="panel-title">
                    <i class="bi bi-grid-3x3-gap"></i>
                    Part Assessment {{ now()->year }}
                </div>

                <div class="part-rank-filter-box">
                    
                    <form method="GET" action="{{ route('dashboard') }}" id="partRankingForm" class="part-rank-filter-form">
                        @foreach(request()->except(['part_rank_type', 'part_rank_divisi_id', 'page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $item)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <select name="part_rank_type" class="part-rank-select part-ranking-auto-filter">
                            <option value="top" {{ $selectedPartRankType === 'top' ? 'selected' : '' }}>
                                Paling Banyak Operator Lulus
                            </option>

                            <option value="low" {{ $selectedPartRankType === 'low' ? 'selected' : '' }}>
                                Paling Banyak Operator Tidak Lulus
                            </option>
                        </select>

                        <select name="part_rank_divisi_id" class="part-rank-select part-ranking-auto-filter">
                            <option value="">Semua Divisi</option>

                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi->id }}" {{ (string) $selectedPartRankDivisiId === (string) $divisi->id ? 'selected' : '' }}>
                                    {{ $divisi->nama_divisi }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="area-list">
            @forelse($partRankingRows as $row)
                <div class="area-item">
                    <div class="area-top">
                        <span title="{{ $row['nama_part'] }}">
                            {{ $row['nama_part'] }}
                        </span>

                        <span class="area-value">
                            {{ $row['total'] }} operator
                        </span>
                    </div>

                    <div class="area-sub" title="No Part: {{ $row['no_part'] }} • Proses: {{ $row['proses'] }} • Kategori: {{ $row['kategori'] }}">
                        No Part: {{ $row['no_part'] }} • Proses: {{ $row['proses'] }} • Kategori: {{ $row['kategori'] }}
                    </div>

                    <div class="area-bar">
                        <div class="area-fill" style="width: {{ min(($row['total'] / $maxPartRankingTotal) * 100, 100) }}%"></div>
                    </div>
                </div>
            @empty
                <div class="area-empty">
                    Belum ada data untuk filter yang dipilih.
                </div>
            @endforelse
        </div>

        <a href="#monitoring-assessment" class="see-all-link">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="card-shell mid-card target-card">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-bullseye"></i>
                Pencapaian Target
            </div>

            <div class="dropdown target-dropdown">
                <button class="target-select-btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    {{ $selectedTargetPeriode
                        ? \Carbon\Carbon::create(
                            $selectedTargetPeriode->tahun,
                            $selectedTargetPeriode->bulan,
                            1
                        )->translatedFormat('M Y')
                        : 'Pilih'
                    }}
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    @foreach($periodes as $periode)
                        <a class="dropdown-item {{ optional($selectedTargetPeriode)->id == $periode->id ? 'active' : '' }}"
                           href="{{ route('dashboard', array_merge(request()->except('target_periode_id'), ['target_periode_id' => $periode->id])) }}">
                            {{ \Carbon\Carbon::create($periode->tahun, $periode->bulan, 1)->translatedFormat('F Y') }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="target-list d-flex flex-column h-100">
            @foreach($targetCategoryRows as $row)
                @php
                    $fillClass = match($row['status']['class']) {
                        'target-success' => 'fill-success',
                        'target-info' => 'fill-info',
                        'target-warning' => 'fill-warning',
                        default => 'fill-danger',
                    };
                @endphp

                <div class="target-row">
                    <div class="target-top">
                        <div class="target-name">
                            <span class="dot"></span>
                            {{ $row['name'] }}
                        </div>

                        <div class="target-pill {{ $row['status']['class'] }}">
                            {{ $row['status']['label'] }}
                        </div>

                        <div class="target-value">
                            {{ $row['actual'] }}/{{ $row['target'] }}
                        </div>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill {{ $fillClass }}" style="width: {{ min($row['percent'], 100) }}%"></div>
                    </div>

                    <div class="target-percent">{{ $row['percent'] }}%</div>
                </div>
            @endforeach
        </div>

        <div class="target-summary">
            <span>{{ $targetAchieved }} dari {{ count($targetCategoryRows) }} area tercapai</span>
            <span>{{ $targetProgress }} masih progress</span>
        </div>
    </div>
</div>

    @php
        $chartWidth = 1080;
        $chartHeight = 300;
        $marginLeft = 58;
        $marginRight = 65;
        $marginTop = 20;
        $marginBottom = 44;

        $plotWidth = $chartWidth - $marginLeft - $marginRight;
        $plotHeight = $chartHeight - $marginTop - $marginBottom;

        $maxActual = collect($monthlyRows)->max('actual') ?? 0;
        $maxTarget = collect($monthlyRows)->max('target') ?? 0;
        $leftAxisMax = max($maxActual, $maxTarget, 10);

        $actualToY = function ($value) use ($marginTop, $plotHeight, $leftAxisMax) {
            return $marginTop + ($plotHeight - (($value / $leftAxisMax) * $plotHeight));
        };

        $percentToY = function ($value) use ($marginTop, $plotHeight) {
            return $marginTop + ($plotHeight - ((min($value, 100) / 100) * $plotHeight));
        };

        $countMonth = count($monthlyRows);
        $stepX = $countMonth > 1 ? ($plotWidth / ($countMonth - 1)) : $plotWidth;

        $targetPoints = [];
        $percentPoints = [];

        foreach ($monthlyRows as $index => $row) {
            $x = $marginLeft + ($index * $stepX);
            $targetPoints[] = $x . ',' . $actualToY($row['target']);
            $percentPoints[] = $x . ',' . $percentToY($row['percent']);
        }
    @endphp

    <div class="insight-chart-grid section-space">
        <div class="card-shell">
            <div class="panel-head">
                <div class="panel-title"><i class="bi bi-bar-chart-line"></i> Assessment Performance Insight</div>
            </div>

            <div class="insight-body">
                <div class="insight-mini">
                    <div class="insight-label">Top Division</div>
                    <div class="insight-title">{{ $topDivision['name'] ?? '-' }}</div>
                    <div class="insight-sub">{{ $topDivision['total'] ?? 0 }} assessment</div>
                    <div class="insight-circle"><i class="bi bi-buildings"></i></div>
                </div>

                <div class="insight-mini">
                    <div class="insight-label">Lowest Target</div>
                    <div class="insight-title">{{ $lowestTarget['name'] ?? '-' }}</div>
                    <div class="insight-sub">{{ $lowestTarget['percent'] ?? 0 }}% pencapaian</div>
                    <div class="insight-circle" style="color:#F3797E;background:#FDEEEF;"><i class="bi bi-activity"></i></div>
                </div>

                <div class="insight-mini">
                    <div class="insight-label">Most Active Leader</div>
                    <div class="insight-title">{{ $mostActiveLeader->name ?? '-' }}</div>
                    <div class="insight-sub">{{ $mostActiveLeader->total_assessment ?? 0 }} assessment</div>
                    <div class="insight-circle"><i class="bi bi-person-check"></i></div>
                </div>

                <div class="insight-mini">
                    <div class="insight-label" style="color:#F3797E;">Need Attention</div>
                    <div class="insight-title">{{ $totalBelumMengisi }} Operator</div>
                    <div class="insight-sub">Belum mengisi</div>
                    <div class="insight-circle" style="color:#E69A00;background:#FFF4DF;"><i class="bi bi-exclamation-triangle"></i></div>
                </div>
            </div>
        </div>

        <div class="card-shell chart-card">
            <div class="panel-head">
                <div class="panel-title">
                    <i class="bi bi-bar-chart-line"></i>
                    Target vs Aktual Skill Assessment per Bulan — {{ now()->year }}
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="panel-badge">Aktual • Target • Pencapaian (%)</span>
                </div>
            </div>

            <div class="chart-wrap">
                <div class="chart-legend">
                    <span class="legend-item">
                        <span class="legend-box" style="background: linear-gradient(180deg, #98BDFF, #4B49AC);"></span>
                        Aktual
                    </span>

                    <span class="legend-item">
                        <span class="legend-line dashed" style="border-color:#F3797E;"></span>
                        Target
                    </span>

                    <span class="legend-item">
                        <span class="legend-line" style="border-color:#7978E9;"></span>
                        Pencapaian (%)
                    </span>
                </div>

                <div style="overflow-x:auto;">
                    <svg width="100%" viewBox="0 0 {{ $chartWidth }} {{ $chartHeight }}" preserveAspectRatio="xMidYMid meet">
                        @for($i = 0; $i <= 5; $i++)
                            @php
                                $y = $marginTop + (($plotHeight / 5) * $i);
                                $labelValue = round($leftAxisMax - (($leftAxisMax / 5) * $i));
                                $rightLabel = round(100 - ((100 / 5) * $i));
                            @endphp

                            <line x1="{{ $marginLeft }}" y1="{{ $y }}" x2="{{ $chartWidth - $marginRight }}" y2="{{ $y }}" stroke="#E8ECF7" stroke-width="1"/>

                            <text x="{{ $marginLeft - 12 }}" y="{{ $y + 4 }}" text-anchor="end" font-size="10" fill="#65738F" font-weight="700">
                                {{ $labelValue }}
                            </text>

                            <text x="{{ $chartWidth - $marginRight + 12 }}" y="{{ $y + 4 }}" text-anchor="start" font-size="10" fill="#65738F" font-weight="700">
                                {{ $rightLabel }}%
                            </text>
                        @endfor

                        <line x1="{{ $marginLeft }}" y1="{{ $marginTop }}" x2="{{ $marginLeft }}" y2="{{ $marginTop + $plotHeight }}" stroke="#CBD5E1" stroke-width="1.2"/>
                        <line x1="{{ $marginLeft }}" y1="{{ $marginTop + $plotHeight }}" x2="{{ $chartWidth - $marginRight }}" y2="{{ $marginTop + $plotHeight }}" stroke="#CBD5E1" stroke-width="1.2"/>

                        <polyline fill="none" stroke="#F3797E" stroke-width="3" stroke-dasharray="7 6" points="{{ implode(' ', $targetPoints) }}" />
                        <polyline fill="none" stroke="#7978E9" stroke-width="3" points="{{ implode(' ', $percentPoints) }}" />

                        @foreach($monthlyRows as $index => $row)
                            @php
                                $x = $marginLeft + ($index * $stepX);
                                $yPercent = $percentToY($row['percent']);
                            @endphp

                            <circle cx="{{ $x }}" cy="{{ $yPercent }}" r="4.6" fill="#7978E9" stroke="#fff" stroke-width="2">
                                <title>{{ $row['month'] }} - Pencapaian {{ $row['percent'] }}%</title>
                            </circle>
                        @endforeach

                        @foreach($monthlyRows as $index => $row)
                            @php
                                $x = $marginLeft + ($index * $stepX);
                                $barWidth = 28;
                                $barX = $x - ($barWidth / 2);
                                $barY = $actualToY($row['actual']);
                                $barHeight = ($marginTop + $plotHeight) - $barY;
                            @endphp

                            <rect x="{{ $barX }}" y="{{ $barY }}" width="{{ $barWidth }}" height="{{ max($barHeight, 2) }}" rx="9" fill="url(#actualGradient)">
                                <title>{{ $row['month'] }} - Aktual {{ $row['actual'] }} assessment, Target {{ $row['target'] }}, Pencapaian {{ $row['percent'] }}%</title>
                            </rect>

                            <text x="{{ $x }}" y="{{ $barY - 7 }}" text-anchor="middle" font-size="10" fill="#4B49AC" font-weight="900">
                                {{ $row['actual'] }}
                            </text>

                            <text x="{{ $x }}" y="{{ $marginTop + $plotHeight + 23 }}" text-anchor="middle" font-size="11" fill="#4F5F7A" font-weight="800">
                                {{ $row['month'] }}
                            </text>
                        @endforeach

                        <text x="17" y="{{ $marginTop + ($plotHeight / 2) }}" transform="rotate(-90, 17, {{ $marginTop + ($plotHeight / 2) }})" font-size="10" fill="#65738F" font-weight="700">
                            Jumlah Assessment
                        </text>

                        <text x="{{ $chartWidth - 10 }}" y="{{ $marginTop + ($plotHeight / 2) }}" transform="rotate(90, {{ $chartWidth - 10 }}, {{ $marginTop + ($plotHeight / 2) }})" font-size="10" fill="#65738F" font-weight="700">
                            Pencapaian (%)
                        </text>

                        <defs>
                            <linearGradient id="actualGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="#98BDFF"/>
                                <stop offset="100%" stop-color="#4B49AC"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card-shell table-card" id="monitoring-assessment">
        <div class="panel-head">
            <div class="panel-title">
                <i class="bi bi-table"></i>
                Monitoring Assessment Terbaru
            </div>

            <span class="panel-badge">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                Data Monitoring
            </span>
        </div>

        <div class="capped-body">
            <div class="table-filter">
                <form method="GET" action="{{ route('dashboard') }}" id="tableFilterForm">
                    @if(optional($selectedTargetPeriode)->id)
                        <input type="hidden" name="target_periode_id" value="{{ $selectedTargetPeriode->id }}">
                    @endif

                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6">
                            <label class="filter-label">Periode</label>
                            <select name="periode_id" class="form-select filter-input auto-filter">
                                <option value="">Semua Periode</option>
                                @foreach($periodes as $periode)
                                    <option value="{{ $periode->id }}" {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                        {{ $periode->bulan }}/{{ $periode->tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="filter-label">Divisi</label>
                            <select name="divisi_id" class="form-select filter-input auto-filter">
                                <option value="">Semua Divisi</option>
                                @foreach($divisis as $divisi)
                                    <option value="{{ $divisi->id }}" {{ request('divisi_id') == $divisi->id ? 'selected' : '' }}>
                                        {{ $divisi->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="filter-label">Leader</label>
                            <select name="leader_id" class="form-select filter-input auto-filter">
                                <option value="">Semua Leader</option>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}" {{ request('leader_id') == $leader->id ? 'selected' : '' }}>
                                        {{ $leader->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="filter-label">Status</label>
                            <select name="status" class="form-select filter-input auto-filter">
                                <option value="">Semua Status</option>
                                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Menunggu Penilaian</option>
                                <option value="dinilai" {{ request('status') == 'dinilai' ? 'selected' : '' }}>Menunggu Approval</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table assessment-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-start">Operator</th>
                            <th>Divisi</th>
                            <th>Leader</th>
                            <th>Part</th>
                            <th>Periode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="width: 70px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestAssessments as $assessment)
                            @php
                                $statusLabel = match($assessment->status) {
                                    'submitted' => 'Menunggu Penilaian',
                                    'dinilai' => 'Menunggu Approval',
                                    'lulus' => 'Lulus',
                                    'tidak_lulus' => 'Tidak Lulus',
                                    default => ucfirst(str_replace('_', ' ', $assessment->status ?? '-')),
                                };

                                $statusClass = match($assessment->status) {
                                    'submitted' => 'status-submitted',
                                    'dinilai' => 'status-dinilai',
                                    'lulus' => 'status-lulus',
                                    'tidak_lulus' => 'status-tidak_lulus',
                                    default => 'status-submitted',
                                };

                                $tanggalAssessment =
                                    $assessment->getAttribute('tanggal_submit')
                                    ?? $assessment->getAttribute('submitted_at')
                                    ?? $assessment->getAttribute('created_at')
                                    ?? $assessment->getAttribute('updated_at');
                            @endphp

                            <tr>
                                <td class="text-start">
                                    <div class="operator-cell">
                                        <div class="operator-avatar">
                                            {{ strtoupper(substr($assessment->operator->nama_lengkap ?? '-', 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="operator-name">{{ $assessment->operator->nama_lengkap ?? '-' }}</div>
                                            <div class="operator-nik">NIK: {{ $assessment->operator->nik ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $assessment->operator->divisi->nama_divisi ?? '-' }}</td>
                                <td>{{ $assessment->operator->leader->name ?? '-' }}</td>
                                <td>{{ $assessment->part->nama_part ?? '-' }}</td>
                                <td>{{ $assessment->periode->bulan ?? '-' }}/{{ $assessment->periode->tahun ?? '-' }}</td>

                                <td>
                                    @if($tanggalAssessment)
                                        {{ \Carbon\Carbon::parse($tanggalAssessment)->format('d/m/Y') }}<br>
                                        <span class="text-muted small">
                                            {{ \Carbon\Carbon::parse($tanggalAssessment)->format('H:i') }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    <span class="status-pill {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('rekapitulasi.print', $assessment->id) }}"
                                       target="_blank"
                                       class="btn-eye"
                                       title="Detail/Cetak Assessment">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        Data assessment belum tersedia pada filter ini.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="text-muted small" style="font-weight: 650;">
                    Menampilkan {{ $latestAssessments->firstItem() ?? 0 }} - {{ $latestAssessments->lastItem() ?? 0 }}
                    dari {{ $latestAssessments->total() }} data
                </div>

                <div>
                    {{ $latestAssessments->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tableFilterForm = document.getElementById('tableFilterForm');
    const partRankingForm = document.getElementById('partRankingForm');

    function submitCleanForm(form) {
        if (!form) {
            return;
        }

        const fields = form.querySelectorAll('input, select');

        fields.forEach(function (field) {
            if (field.value === '') {
                field.disabled = true;
            }
        });

        form.submit();
    }

    document.querySelectorAll('.auto-filter').forEach(function (element) {
        element.addEventListener('change', function () {
            submitCleanForm(tableFilterForm);
        });
    });

    document.querySelectorAll('.part-ranking-auto-filter').forEach(function (element) {
        element.addEventListener('change', function () {
            submitCleanForm(partRankingForm);
        });
    });
</script>

@endsection
