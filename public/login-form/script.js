// Creative Login Form JavaScript
class CreativeLoginForm {
    constructor() {
        this.form = document.getElementById('loginForm');
        this.emailInput = document.getElementById('email');
        this.passwordInput = document.getElementById('password');
        this.passwordToggle = document.getElementById('passwordToggle');
        this.submitButton = this.form.querySelector('.login-btn');
        this.successMessage = document.getElementById('successMessage');
        this.socialButtons = document.querySelectorAll('.social-btn');

        this.init();
    }

    init() {
        this.bindEvents();
        this.setupPasswordToggle();
        this.setupCreativeEffects();
    }

    bindEvents() {
        this.emailInput.addEventListener('focus', () => this.addInputFocus('email'));
        this.passwordInput.addEventListener('focus', () => this.addInputFocus('password'));
        this.emailInput.addEventListener('blur', () => this.removeInputFocus('email'));
        this.passwordInput.addEventListener('blur', () => this.removeInputFocus('password'));
    }

    setupPasswordToggle() {
        this.passwordToggle.addEventListener('click', () => {
            const type = this.passwordInput.type === 'password' ? 'text' : 'password';
            this.passwordInput.type = type;

            const icon = this.passwordToggle.querySelector('.toggle-icon');
            icon.classList.toggle('show-password', type === 'text');

            // Add creative toggle effect
            this.passwordToggle.style.transform = 'translateY(-50%) scale(1.2)';
            setTimeout(() => {
                this.passwordToggle.style.transform = 'translateY(-50%) scale(1)';
            }, 150);
        });
    }

    setupSocialButtons() {
        this.socialButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const platform = button.classList.contains('behance-btn') ? 'Behance' : 'Dribbble';
                this.handleSocialLogin(platform, button);
            });
        });
    }

    setupCreativeEffects() {
        // Add mouse tracking for creative elements
        document.addEventListener('mousemove', (e) => {
            this.updateFloatingShapes(e);
        });

        // Add card tilt effect
        const card = document.querySelector('.login-card');
        card.addEventListener('mousemove', (e) => {
            this.addCardTilt(e, card);
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    }

    updateFloatingShapes(e) {
        const shapes = document.querySelectorAll('.shape');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.5;
            const x = (mouseX - 0.5) * speed * 20;
            const y = (mouseY - 0.5) * speed * 20;

            shape.style.transform = `translate(${x}px, ${y}px)`;
        });
    }

    addCardTilt(e, card) {
        const rect = card.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const mouseX = e.clientX - centerX;
        const mouseY = e.clientY - centerY;

        const rotateX = (mouseY / rect.height) * -10;
        const rotateY = (mouseX / rect.width) * 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    }

    addInputFocus(field) {
        const inputWrapper = document.getElementById(field).closest('.input-wrapper');
        inputWrapper.classList.add('focused');

        // Add sparkle effect
        this.createSparkles(inputWrapper);
    }

    removeInputFocus(field) {
        const inputWrapper = document.getElementById(field).closest('.input-wrapper');
        inputWrapper.classList.remove('focused');
    }

    createSparkles(element) {
        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.style.cssText = `
                    position: absolute;
                    width: 4px;
                    height: 4px;
                    background: #667eea;
                    border-radius: 50%;
                    pointer-events: none;
                    top: ${Math.random() * 100}%;
                    left: ${Math.random() * 100}%;
                    animation: sparkleFloat 1s ease-out forwards;
                    z-index: 10;
                `;

                element.appendChild(sparkle);

                setTimeout(() => {
                    sparkle.remove();
                }, 1000);
            }, i * 100);
        }

        // Add sparkle animation if not exists
        if (!document.querySelector('#sparkle-keyframes')) {
            const style = document.createElement('style');
            style.id = 'sparkle-keyframes';
            style.textContent = `
                @keyframes sparkleFloat {
                    0% { opacity: 1; transform: translateY(0) scale(0); }
                    50% { opacity: 1; transform: translateY(-20px) scale(1); }
                    100% { opacity: 0; transform: translateY(-40px) scale(0); }
                }
            `;
            document.head.appendChild(style);
        }
    }

    async handleSocialLogin(platform, button) {
        console.log(`Initiating creative login with ${platform}...`);

        // Add creative social login effect
        button.style.transform = 'scale(0.95)';
        button.style.opacity = '0.7';

        try {
            await new Promise(resolve => setTimeout(resolve, 1500));
            console.log(`Redirecting to ${platform} for creative authentication...`);
            // window.location.href = `/auth/${platform.toLowerCase()}`;
        } catch (error) {
            console.error(`Creative ${platform} authentication failed: ${error.message}`);
        } finally {
            button.style.transform = 'scale(1)';
            button.style.opacity = '1';
        }
    }
}

// Initialize the form when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new CreativeLoginForm();
});
