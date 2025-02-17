import './bootstrap';

// إدارة Tooltips
const TooltipManager = {
    tooltips: [],

    // تهيئة جميع tooltips
    init() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        this.tooltips = tooltipTriggerList.map(tooltipTriggerEl => {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover focus',  // تفعيل عند hover أو focus
                placement: 'auto',       // وضع تلقائي
                html: true,              // السماح باستخدام HTML
                animation: true          // تفعيل الحركة
            });
        });
    },

    // إظهار tooltip محدد
    show(element) {
        const tooltip = bootstrap.Tooltip.getInstance(element);
        if (tooltip) {
            tooltip.show();
        }
    },

    // إخفاء tooltip محدد
    hide(element) {
        const tooltip = bootstrap.Tooltip.getInstance(element);
        if (tooltip) {
            tooltip.hide();
        }
    },

    // تحديث محتوى tooltip
    updateContent(element, newContent) {
        const tooltip = bootstrap.Tooltip.getInstance(element);
        if (tooltip) {
            element.setAttribute('data-bs-original-title', newContent);
            tooltip.update();
        }
    },

    // إزالة جميع tooltips
    disposeAll() {
        this.tooltips.forEach(tooltip => {
            tooltip.dispose();
        });
        this.tooltips = [];
    }
};

// تهيئة Tooltips عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    TooltipManager.init();

    // مثال على استخدام الوظائف الإضافية
    document.addEventListener('click', (e) => {
        const tooltipTrigger = e.target.closest('[data-bs-toggle="tooltip"]');
        if (tooltipTrigger) {
            // يمكنك إضافة منطق خاص هنا
            // مثال: TooltipManager.updateContent(tooltipTrigger, 'محتوى جديد');
        }
    });
});

// إعادة تهيئة Tooltips عند تحديث محتوى الصفحة بشكل ديناميكي
document.addEventListener('contentChanged', () => {
    TooltipManager.disposeAll();
    TooltipManager.init();
});
