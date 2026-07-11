@extends('layouts.app')

@section('content')

@php
    $remainingDays = $stats['remaining_days'];
    $durationText = $stats['duration_days'] !== null ? number_format($stats['duration_days']) . ' يوم' : '-';
    $remainingDaysText = $remainingDays === null
        ? '-'
        : ($remainingDays >= 0 ? number_format($remainingDays) . ' يوم' : 'متأخر ' . number_format(abs($remainingDays)) . ' يوم');
    $remainingTone = $remainingDays === null
        ? 'neutral'
        : ($remainingDays < 0 ? 'danger' : ($remainingDays <= 30 ? 'warning' : 'success'));
@endphp

<style>
body {
    background: #F8F4E8;
}

.stats-page {
    margin: 35px 48px 60px;
    direction: rtl;
    color: #4B3F1F;
}

.stats-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 22px 26px;
    margin-bottom: 24px;
    background: #F8F4E8;
    border: 2px solid #C8B27A;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(111, 90, 36, .08);
}

.stats-title-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
}

.stats-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #6F5A24;
    color: #fff;
    font-size: 25px;
}

.stats-title {
    margin: 0;
    color: #6F5A24;
    font-weight: 900;
    font-size: 25px;
}

.stats-subtitle {
    color: #8A7745;
    margin-top: 4px;
    font-weight: 600;
}

.stats-pill {
    background: #fff;
    border: 1px solid #D8C187;
    border-radius: 12px;
    padding: 12px 16px;
    min-width: 150px;
    text-align: center;
}

.stats-pill span {
    display: block;
    color: #6F5A24;
    font-weight: 900;
    font-size: 20px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 16px;
    margin-bottom: 22px;
}

.stat-card,
.stats-panel {
    background: #fff;
    border: 1px solid #D8C187;
    border-radius: 12px;
    box-shadow: 0 10px 26px rgba(111, 90, 36, .07);
}

.stat-card {
    min-height: 132px;
    padding: 18px;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    inset-inline-start: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: #6F5A24;
}

.stat-card.success::before { background: #427A52; }
.stat-card.warning::before { background: #B98A25; }
.stat-card.danger::before { background: #A94C4C; }
.stat-card.neutral::before { background: #8A7745; }

.stat-label {
    color: #8A7745;
    font-weight: 800;
    font-size: 13px;
    margin-bottom: 8px;
}

.stat-value {
    color: #4B3F1F;
    font-weight: 900;
    font-size: 24px;
    line-height: 1.45;
}

.stat-foot {
    margin-top: 8px;
    color: #9A8750;
    font-size: 12px;
    font-weight: 700;
}

.stats-layout {
    display: grid;
    grid-template-columns: minmax(300px, 1.15fr) minmax(300px, .85fr);
    gap: 18px;
}

.stats-panel {
    padding: 20px;
}

.panel-title {
    color: #6F5A24;
    font-weight: 900;
    font-size: 18px;
    margin-bottom: 18px;
}

.rings {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(145px, 1fr));
    gap: 18px;
}

.ring-box {
    text-align: center;
}

.ring {
    width: 132px;
    height: 132px;
    margin: 0 auto 10px;
    border-radius: 50%;
    background:
        radial-gradient(circle at center, #fff 58%, transparent 59%),
        conic-gradient(var(--ring-color) calc(var(--value) * 1%), #F0E8D3 0);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4B3F1F;
    font-weight: 900;
    font-size: 23px;
}

.ring-label {
    color: #8A7745;
    font-weight: 800;
}

.bar-chart {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 10px;
    height: 220px;
    padding-top: 12px;
    border-bottom: 1px solid #E4D4A0;
}

.bar-item {
    flex: 1;
    min-width: 36px;
    text-align: center;
}

.bar {
    width: 100%;
    min-height: 8px;
    border-radius: 9px 9px 0 0;
    background: linear-gradient(180deg, #8C7331, #6F5A24);
}

.bar-count {
    color: #6F5A24;
    font-weight: 900;
    font-size: 13px;
    margin-bottom: 6px;
}

.bar-label {
    margin-top: 8px;
    color: #8A7745;
    font-size: 12px;
    font-weight: 800;
}

.progress-list {
    display: grid;
    gap: 14px;
}

.progress-row {
    display: grid;
    gap: 7px;
}

.progress-meta {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    color: #6F5A24;
    font-weight: 800;
}

.progress-track {
    height: 12px;
    background: #F0E8D3;
    border-radius: 50px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: inherit;
    background: linear-gradient(90deg, #6F5A24, #B89B2E);
}

.mini-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
}

.mini-table th,
.mini-table td {
    padding: 12px;
    border-bottom: 1px solid #EFE4C0;
    text-align: right;
}

.mini-table th {
    color: #6F5A24;
    font-weight: 900;
    background: #F8F4E8;
}

.mini-table td {
    color: #4B3F1F;
    font-weight: 700;
}

@media (max-width: 900px) {
    .stats-page {
        margin: 20px 14px 40px;
    }

    .stats-header,
    .stats-layout {
        grid-template-columns: 1fr;
    }

    .stats-header {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<div class="stats-page">
    <div class="stats-header">
        <div class="stats-title-wrap">
            <div class="stats-icon">
                <i class="fas fa-chart-pie"></i>
            </div>

            <div>
                <h2 class="stats-title">احصائيات المشروع</h2>
                <div class="stats-subtitle">
                    {{ $project->project_code ?? '-' }}
                    @if($project->projectName)
                        - {{ $project->projectName->name_ar }}
                    @endif
                </div>
            </div>
        </div>

        <div class="stats-pill">
            <small>مرحلة المشروع</small>
            <span>{{ $project->stage?->name_ar ?? '-' }}</span>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card neutral">
            <div class="stat-label">مدة المشروع</div>
            <div class="stat-value">{{ $durationText }}</div>
            <div class="stat-foot">
                {{ $project->contract_signed_at?->format('Y-m-d') ?? $project->start_date?->format('Y-m-d') ?? '-' }}
                /
                {{ $project->contractor_contract_end_date?->format('Y-m-d') ?? $project->end_date?->format('Y-m-d') ?? '-' }}
            </div>
        </div>

        <div class="stat-card {{ $remainingTone }}">
            <div class="stat-label">المدة المتبقية</div>
            <div class="stat-value">{{ $remainingDaysText }}</div>
            <div class="stat-foot">حسب تاريخ انتهاء عقد المقاول</div>
        </div>

        <div class="stat-card success">
            <div class="stat-label">نسبة الانجاز</div>
            <div class="stat-value">{{ $stats['achievement_percent'] }}%</div>
            <div class="stat-foot">
                @if($stats['latest_batch_id'])
                    من آخر دفعة رقم {{ $stats['latest_batch_id'] }}
                @else
                    محسوبة من المدفوعات
                @endif
            </div>
        </div>

        <div class="stat-card neutral">
            <div class="stat-label">عدد الزيارات الشهرية</div>
            <div class="stat-value">{{ number_format($stats['current_month_supervisions']) }}</div>
            <div class="stat-foot">إجمالي الزيارات: {{ number_format($stats['total_supervisions']) }}</div>
        </div>

        <div class="stat-card success">
            <div class="stat-label">المبلغ المدفوع</div>
            <div class="stat-value">{{ number_format($stats['paid_amount'], 0) }}</div>
            <div class="stat-foot">من قيمة عقد {{ number_format($stats['contract_value'], 0) }}</div>
        </div>

        <div class="stat-card warning">
            <div class="stat-label">المبلغ المتبقي</div>
            <div class="stat-value">{{ number_format($stats['remaining_amount'], 0) }}</div>
            <div class="stat-foot">
                @if($stats['over_paid_amount'] > 0)
                    يوجد زيادة {{ number_format($stats['over_paid_amount'], 0) }}
                @else
                    حتى اكتمال قيمة العقد
                @endif
            </div>
        </div>
    </div>

    <div class="stats-layout">
        <div class="stats-panel">
            <div class="panel-title">مؤشرات التقدم</div>

            <div class="rings">
                <div class="ring-box">
                    <div class="ring"
                         style="--value: {{ $stats['achievement_percent'] }}; --ring-color: #427A52;">
                        {{ $stats['achievement_percent'] }}%
                    </div>
                    <div class="ring-label">الانجاز</div>
                </div>

                <div class="ring-box">
                    <div class="ring"
                         style="--value: {{ $stats['payment_progress_percent'] }}; --ring-color: #8C7331;">
                        {{ $stats['payment_progress_percent'] }}%
                    </div>
                    <div class="ring-label">المدفوعات</div>
                </div>

                <div class="ring-box">
                    <div class="ring"
                         style="--value: {{ $stats['time_progress_percent'] }}; --ring-color: #B98A25;">
                        {{ $stats['time_progress_percent'] }}%
                    </div>
                    <div class="ring-label">استهلاك الوقت</div>
                </div>
            </div>

            <div class="progress-list mt-4">
                <div class="progress-row">
                    <div class="progress-meta">
                        <span>المبلغ المدفوع</span>
                        <span>{{ number_format($stats['paid_amount'], 0) }} / {{ number_format($stats['contract_value'], 0) }}</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $stats['payment_progress_percent'] }}%;"></div>
                    </div>
                </div>

                <div class="progress-row">
                    <div class="progress-meta">
                        <span>مدة المشروع المستخدمة</span>
                        <span>{{ $stats['time_progress_percent'] }}%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $stats['time_progress_percent'] }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-panel">
            <div class="panel-title">زيارات الإشراف خلال آخر 6 شهور</div>

            <div class="bar-chart">
                @foreach($stats['monthly_visits'] as $month)
                    @php
                        $height = $stats['max_monthly_visits'] > 0
                            ? max(8, ($month['count'] / $stats['max_monthly_visits']) * 175)
                            : 8;
                    @endphp

                    <div class="bar-item">
                        <div class="bar-count">{{ $month['count'] }}</div>
                        <div class="bar" style="height: {{ $height }}px;"></div>
                        <div class="bar-label">{{ $month['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="stats-panel mt-3">
        <div class="panel-title">آخر بيانات جدول الدفعات</div>

        <table class="mini-table">
            <thead>
                <tr>
                    <th>البند</th>
                    <th>المستهدف</th>
                    <th>الانجاز</th>
                    <th>قيمة الدفعة</th>
                </tr>
            </thead>

            <tbody>
                @forelse($stats['latest_schedule_rows']->take(8) as $row)
                    <tr>
                        <td>{{ $row->title ?? '-' }}</td>
                        <td>{{ $row->target_percentage ?? 0 }}%</td>
                        <td>{{ $row->completion_percentage ?? 0 }}%</td>
                        <td>{{ number_format($row->amount ?? 0, 0) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">لا توجد بيانات دفعات حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
