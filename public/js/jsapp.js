// Modern Sidebar Functionality
class ModernSidebar {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'light';
        this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        this.init();
    }

    init() {
        this.applyTheme();
        this.setupEventListeners();
        this.setupSidebar();
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
                !sidebar.contains(e.target) &&
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

        // Active link highlighting
        this.highlightActiveLink();
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

        // Dispatch event for Livewire components
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: this.theme }));
    }

    applyTheme() {
        document.documentElement.setAttribute('data-theme', this.theme);

        const themeIcon = document.getElementById('themeIcon');
        if (themeIcon) {
            themeIcon.className = this.theme === 'light' ? 'bi bi-moon' : 'bi bi-sun';
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
});

// Export for global access
window.ModernSidebar = ModernSidebar;
