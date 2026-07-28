/* ============================================================
   澈言 CHEYAN — 交互脚本（重构版）
   主题切换 · 纪录片视频弹窗 · 事件照片弹窗
   ============================================================ */
(function () {
    "use strict";

    var THEME_KEY = "theme-preference";
    var VIDEO_ID = "nJZTpk1Lf_8";

    /* ---------- 主题切换 / Theme ---------- */
    function applyTheme(theme) {
        document.documentElement.setAttribute("data-theme", theme);
        var btn = document.getElementById("theme-toggle");
        var icon = document.querySelector(".theme-icon");
        if (icon) icon.textContent = theme === "dark" ? "☀️" : "🌙";
        if (btn) {
            btn.setAttribute("aria-label",
                theme === "dark" ? "切换到明亮主题" : "切换到暗色主题");
        }
    }

    function savedTheme() {
        try {
            var t = localStorage.getItem(THEME_KEY);
            return t === "dark" || t === "light" ? t : "light";
        } catch (e) {
            return "light";
        }
    }

    function initTheme() {
        applyTheme(savedTheme());
        var btn = document.getElementById("theme-toggle");
        if (!btn) return;
        btn.addEventListener("click", function () {
            var next = document.documentElement.getAttribute("data-theme") === "dark"
                ? "light" : "dark";
            applyTheme(next);
            try { localStorage.setItem(THEME_KEY, next); } catch (e) {}
            btn.style.transform = "scale(0.9)";
            setTimeout(function () { btn.style.transform = ""; }, 150);
        });
    }

    /* ---------- 视频弹窗 / Video modal ---------- */
    function openVideoModal() {
        var modal = document.getElementById("video-modal");
        var player = document.getElementById("youtube-player");
        if (!modal || !player) return;
        player.src = "https://www.youtube.com/embed/" + VIDEO_ID + "?autoplay=1&rel=0";
        modal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function closeVideoModal() {
        var modal = document.getElementById("video-modal");
        var player = document.getElementById("youtube-player");
        if (!modal) return;
        modal.style.display = "none";
        if (player) player.src = "";
        document.body.style.overflow = "auto";
    }

    window.openVideoModal = openVideoModal;
    window.closeVideoModal = closeVideoModal;

    /* ---------- 事件照片弹窗 / Event photo modal ---------- */
    function openEventPhotoModal(src, caption, title, date) {
        var modal = document.getElementById("event-photo-modal");
        if (!modal) return;
        var img = document.getElementById("event-photo-modal-img");
        var titleEl = document.getElementById("event-photo-modal-title");
        var descEl = document.getElementById("event-photo-modal-desc");
        var dateEl = document.getElementById("event-photo-modal-date");
        if (img) { img.src = src || ""; img.alt = caption || title || ""; }
        if (titleEl) titleEl.textContent = title || "";
        if (descEl) descEl.innerHTML = caption || ""; // 允许 <br> 等内联标记
        if (dateEl) dateEl.textContent = date || "";
        modal.classList.add("open");
        document.body.style.overflow = "hidden";
    }

    function closeEventPhotoModal() {
        var modal = document.getElementById("event-photo-modal");
        if (!modal) return;
        modal.classList.remove("open");
        document.body.style.overflow = "auto";
    }

    /* ---------- 事件委托 / Global delegation ---------- */
    document.addEventListener("click", function (event) {
        // 视频弹窗：点击遮罩关闭
        var videoModal = document.getElementById("video-modal");
        if (videoModal && videoModal.style.display === "block" && event.target === videoModal) {
            closeVideoModal();
            return;
        }
        // 事件照片：点击遮罩或关闭按钮关闭
        var photoModal = document.getElementById("event-photo-modal");
        if (photoModal && photoModal.classList.contains("open")) {
            if (event.target === photoModal ||
                (event.target.classList && event.target.classList.contains("photo-close"))) {
                closeEventPhotoModal();
                return;
            }
        }
        // 事件照片：点击图片打开
        var fig = event.target.closest && event.target.closest(".event-photo-figure");
        if (fig) {
            var src = fig.getAttribute("data-photo") ||
                (fig.querySelector("img") ? fig.querySelector("img").src : "");
            var caption = fig.getAttribute("data-caption") || (function () {
                var capEl = fig.querySelector(".event-photo-caption");
                return capEl ? capEl.innerHTML : "";
            })();
            openEventPhotoModal(src, caption,
                fig.getAttribute("data-title") || "",
                fig.getAttribute("data-date") || "");
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeVideoModal();
            closeEventPhotoModal();
        }
    });

    /* ---------- 启动 / Init ---------- */
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initTheme);
    } else {
        initTheme();
    }
})();