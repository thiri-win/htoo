export const CHART_COLORS = [
    '#f87171', '#60a5fa', '#fbbf24', '#34d399', '#a78bfa',
    '#f472b6', '#facc15', '#38bdf8', '#fb7185', '#4ade80',
];

export const emptyChartData = () => ({ labels: [] as string[], datasets: [] as object[] });

export function baseChartOptions(title: string, extra: Record<string, unknown> = {}) {
    return {
        responsive: true,
        plugins: {
            legend: { position: 'top' as const },
            title: { display: true, text: title },
        },
        ...extra,
    };
}

export function categoryStackChartData(
    categorySumByPeriod: Record<string, Record<string, number>> | undefined,
) {
    if (!categorySumByPeriod || Object.keys(categorySumByPeriod).length === 0) {
        return emptyChartData();
    }

    const labels = Object.keys(categorySumByPeriod);
    const categories = Object.keys(categorySumByPeriod[labels[0]] || {});

    return {
        labels,
        datasets: categories.map((category, index) => ({
            label: category,
            data: labels.map(period => categorySumByPeriod[period][category] || 0),
            backgroundColor: CHART_COLORS[index % CHART_COLORS.length],
        })),
    };
}
