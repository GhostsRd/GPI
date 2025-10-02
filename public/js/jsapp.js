// Modern Sidebar Functionality
class ModernSidebar {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'light';
        this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        this.currentPageTitle = document.title;
        this.init();
    }

    init() {
        this.applyTheme();
        this.setupEventListeners();
        this.setupSidebar();
        this.setupPageTitles();
    }

    setupEventListeners() {
        // Theme toggle
        document.getElementById('themeToggle')?.addEventListener('click', () => this.toggleTheme());

        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => this.toggleSidebar());

        // Mobile menu toggle
        document.getElementById('mobileMenuToggle')?.addEventListener('click', () => this.toggleMobileMenu());

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebarModern');
            const toggleBtn = document.getElementById('mobileMenuToggle');

            if (window.innerWidth <= 768 &&
                sidebar &&
                !sidebar.contains(e.target) &&
                toggleBtn &&
                !toggleBtn.contains(e.target)) {
                this.closeMobileMenu();
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active link highlighting and page title update
        this.setupNavigationLinks();
    }

    setupNavigationLinks() {
        const navLinks = document.querySelectorAll('.nav-link-modern');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                this.handleNavigationClick(link, e);
            });
        });

        this.highlightActiveLink();
    }

    handleNavigationClick(link, event) {
        // Update page title based on clicked menu
        this.updatePageTitle(link);

        // Highlight active link
        this.setActiveLink(link);

        // Close mobile menu after click on mobile
        if (window.innerWidth <= 768) {
            this.closeMobileMenu();
        }
    }

    updatePageTitle(clickedLink) {
        const linkText = clickedLink.querySelector('.nav-text')?.textContent?.trim();
        const iconElement = clickedLink.querySelector('.nav-icon');
        const iconClass = Array.from(iconElement?.classList || []).find(cls => cls.startsWith('bi-'));

        if (linkText) {
            let themeEmoji = this.theme === 'dark' ? '🌙' : '☀️';
            let iconEmoji = this.getIconEmoji(iconClass);

            // Update document title
            document.title = `${iconEmoji} ${linkText} | ${this.getAppName()}`;

            // Update page title in content area if exists
            this.updateContentTitle(linkText, iconEmoji);

            // Save current page title
            this.currentPageTitle = document.title;

            console.log(`Page title updated to: ${linkText} (Theme: ${this.theme})`);
        }
    }

    getIconEmoji(iconClass) {
        const iconMap = {
            'bi-house': '🏠',
            'bi-speedometer2': '📊',
            'bi-person': '👤',
            'bi-people': '👥',
            'bi-envelope': '✉️',
            'bi-bell': '🔔',
            'bi-gear': '⚙️',
            'bi-grid': '🔲',
            'bi-file-text': '📄',
            'bi-bar-chart': '📈',
            'bi-cart': '🛒',
            'bi-wallet': '💰',
            'bi-shield': '🛡️',
            'bi-help-circle': '❓'
        };

        return iconMap[iconClass] || '📄';
    }

    getAppName() {
        return document.querySelector('.app-name')?.textContent || 'Mon Application';
    }

    updateContentTitle(title, emoji) {
        // Update main page title if exists
        const pageTitle = document.querySelector('h1.page-title, .page-header h1, main h1');
        if (pageTitle) {
            pageTitle.innerHTML = `${emoji} ${title}`;
        }

        // Update breadcrumb if exists
        const breadcrumb = document.querySelector('.breadcrumb-current, .current-page');
        if (breadcrumb) {
            breadcrumb.textContent = title;
        }
    }

    setActiveLink(clickedLink) {
        // Remove active class from all links
        document.querySelectorAll('.nav-link-modern').forEach(link => {
            link.classList.remove('active');
        });

        // Add active class to clicked link
        clickedLink.classList.add('active');

        // Also activate parent if in submenu
        this.activateParentMenu(clickedLink);
    }

    activateParentMenu(clickedLink) {
        const parentMenu = clickedLink.closest('.nav-collapse-modern')?.previousElementSibling;
        if (parentMenu && parentMenu.classList.contains('nav-link-modern')) {
            parentMenu.classList.add('active');
        }
    }

    setupPageTitles() {
        // Set initial page title based on active link or current page
        const activeLink = document.querySelector('.nav-link-modern.active');
        if (activeLink) {
            this.updatePageTitle(activeLink);
        }
    }

    setupSidebar() {
        const sidebar = document.getElementById('sidebarModern');
        const mainContent = document.querySelector('.main-content-modern');

        if (this.sidebarCollapsed) {
            sidebar?.classList.add('collapsed');
            mainContent?.classList.add('expanded');
        }
    }

    toggleTheme() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        this.applyTheme();
        localStorage.setItem('theme', this.theme);

        // Update page title with new theme
        const activeLink = document.querySelector('.nav-link-modern.active');
        if (activeLink) {
            this.updatePageTitle(activeLink);
        }

        // Dispatch event for Livewire components
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: this.theme }));
    }

    applyTheme() {
        document.documentElement.setAttribute('data-theme', this.theme);

        const themeIcon = document.getElementById('themeIcon');
        if (themeIcon) {
            themeIcon.className = this.theme === 'light' ? 'bi bi-moon' : 'bi bi-sun';
        }

        // Update theme in UI
        this.updateThemeUI();
    }

    updateThemeUI() {
        const themeBadge = document.querySelector('.theme-badge');
        if (themeBadge) {
            themeBadge.textContent = this.theme === 'light' ? 'Mode Clair' : 'Mode Sombre';
        }
    }

    toggleSidebar() {
        const sidebar = document.getElementById('sidebarModern');
        const mainContent = document.querySelector('.main-content-modern');

        this.sidebarCollapsed = !this.sidebarCollapsed;

        sidebar?.classList.toggle('collapsed');
        mainContent?.classList.toggle('expanded');

        localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
    }

    toggleMobileMenu() {
        const sidebar = document.getElementById('sidebarModern');
        sidebar?.classList.toggle('mobile-open');
    }

    closeMobileMenu() {
        const sidebar = document.getElementById('sidebarModern');
        sidebar?.classList.remove('mobile-open');
    }

    highlightActiveLink() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link-modern');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href)) {
                link.classList.add('active');
            }
        });
    }

    // Method to update notification badges
    updateNotificationBadge(count) {
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    // Method to manually set page title
    setPageTitle(title, emoji = '📄') {
        document.title = `${emoji} ${title} | ${this.getAppName()}`;
        this.updateContentTitle(title, emoji);
        this.currentPageTitle = document.title;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.modernSidebar = new ModernSidebar();
});

// Livewire integration
document.addEventListener('livewire:load', function() {
    // Listen for theme changes from Livewire components
    Livewire.on('changeTheme', (theme) => {
        window.modernSidebar.theme = theme;
        window.modernSidebar.applyTheme();
    });

    // Update notifications when Livewire updates
    Livewire.hook('message.processed', (message, component) => {
        if (message.updateQueue.some(update => update.payload.name === 'notificationCount')) {
            const count = component.get('notificationCount') || 0;
            window.modernSidebar.updateNotificationBadge(count);
        }
    });

    // Update page title when Livewire navigation occurs
    Livewire.hook('navigate', (event) => {
        setTimeout(() => {
            const activeLink = document.querySelector('.nav-link-modern.active');
            if (activeLink && window.modernSidebar) {
                window.modernSidebar.updatePageTitle(activeLink);
            }
        }, 100);
    });
});

// Export for global access
window.ModernSidebar = ModernSidebar;

// Utility function to manually update page title from anywhere
window.updatePageTitle = function(title, emoji = '📄') {
    if (window.modernSidebar) {
        window.modernSidebar.setPageTitle(title, emoji);
    }
};
