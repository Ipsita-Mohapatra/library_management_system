// ============================================
// PROFESSIONAL 3D ANIMATIONS WITH THREE.JS
// ============================================

// Create night sky with stars and moon
function createNightSky(scene) {
    // Create stars
    const starGeometry = new THREE.BufferGeometry();
    const starCount = 500;
    const positionArray = new Float32Array(starCount * 3);

    for (let i = 0; i < starCount * 3; i += 3) {
        positionArray[i] = (Math.random() - 0.5) * 2000;
        positionArray[i + 1] = (Math.random() - 0.5) * 2000;
        positionArray[i + 2] = (Math.random() - 0.5) * 2000;
    }

    starGeometry.setAttribute('position', new THREE.BufferAttribute(positionArray, 3));

    const starMaterial = new THREE.PointsMaterial({
        size: 2,
        color: 0xffffff,
        opacity: 0.8,
        sizeAttenuation: true,
        transparent: true
    });

    const stars = new THREE.Points(starGeometry, starMaterial);
    scene.add(stars);

    // Create moon
    const moonGeometry = new THREE.SphereGeometry(50, 32, 32);
    const moonMaterial = new THREE.MeshStandardMaterial({
        color: 0xf0f0f0,
        emissive: 0xf0f0f0,
        emissiveIntensity: 0.4,
        roughness: 0.9,
        metalness: 0
    });

    const moon = new THREE.Mesh(moonGeometry, moonMaterial);
    moon.position.set(300, 200, -500);
    scene.add(moon);

    // Add moon texture/craters effect
    const craterGeometry = new THREE.SphereGeometry(2, 16, 16);
    const craterMaterial = new THREE.MeshStandardMaterial({
        color: 0xc0c0c0,
        emissive: 0x666666,
        emissiveIntensity: 0.2
    });

    for (let i = 0; i < 15; i++) {
        const crater = new THREE.Mesh(craterGeometry, craterMaterial);
        crater.position.copy(moon.position);
        const randomDir = new THREE.Vector3(
            (Math.random() - 0.5) * 80,
            (Math.random() - 0.5) * 80,
            (Math.random() - 0.5) * 20
        ).normalize();
        crater.position.add(randomDir.multiplyScalar(48));
        scene.add(crater);
    }

    return { stars, moon };
}

// Initialize Three.js Scene for Login Page
function initThreeJsLogin() {
    const canvas = document.getElementById('canvas-3d-login');
    if (!canvas) return;

    // Scene setup
    const scene = new THREE.Scene();
    scene.background = null;
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setClearColor(0x000000, 0);

    // Create particles
    const particleGeometry = new THREE.BufferGeometry();
    const particleCount = 200;
    const positionArray = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount * 3; i += 3) {
        positionArray[i] = (Math.random() - 0.5) * 20;
        positionArray[i + 1] = (Math.random() - 0.5) * 20;
        positionArray[i + 2] = (Math.random() - 0.5) * 20;
    }

    particleGeometry.setAttribute('position', new THREE.BufferAttribute(positionArray, 3));

    const particleMaterial = new THREE.PointsMaterial({
        size: 0.15,
        color: 0x6366f1,
        opacity: 0.6,
        sizeAttenuation: true,
        transparent: true
    });

    const particles = new THREE.Points(particleGeometry, particleMaterial);
    scene.add(particles);

    // Create floating cubes
    const cubes = [];
    for (let i = 0; i < 5; i++) {
        const geometry = new THREE.IcosahedronGeometry(0.5, 4);
        const material = new THREE.MeshPhongMaterial({
            color: 0x8b5cf6,
            emissive: 0x6366f1,
            wireframe: true,
            opacity: 0.3,
            transparent: true
        });
        const mesh = new THREE.Mesh(geometry, material);
        mesh.position.x = (Math.random() - 0.5) * 15;
        mesh.position.y = (Math.random() - 0.5) * 15;
        mesh.position.z = (Math.random() - 0.5) * 10;
        mesh.speed = Math.random() * 0.002 + 0.001;
        mesh.rotationSpeed = Math.random() * 0.02 + 0.005;
        scene.add(mesh);
        cubes.push(mesh);
    }

    // Lighting
    const light1 = new THREE.PointLight(0x6366f1, 1);
    light1.position.set(5, 5, 5);
    scene.add(light1);

    const light2 = new THREE.PointLight(0x8b5cf6, 1);
    light2.position.set(-5, -5, 5);
    scene.add(light2);

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.3);
    scene.add(ambientLight);

    // Add night sky
    const nightSky = createNightSky(scene);

    // Animation loop
    const clock = new THREE.Clock();
    const animate = () => {
        requestAnimationFrame(animate);
        const elapsedTime = clock.getElapsedTime();

        // Animate particles
        particles.rotation.x = elapsedTime * 0.0005;
        particles.rotation.y = elapsedTime * 0.0003;

        // Animate cubes
        cubes.forEach((cube, index) => {
            cube.rotation.x += cube.rotationSpeed;
            cube.rotation.y += cube.rotationSpeed;
            cube.position.y += Math.sin(elapsedTime * cube.speed) * 0.02;
            cube.position.x += Math.cos(elapsedTime * cube.speed * 0.5) * 0.01;
        });

        renderer.render(scene, camera);
    };

    animate();

    // Handle window resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
}

// Initialize Three.js Scene for Dashboard
function initThreeJsDashboard() {
    const canvas = document.getElementById('canvas-3d-dashboard');
    if (!canvas) return;

    const scene = new THREE.Scene();
    scene.background = null;
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setClearColor(0x000000, 0);

    // Create animated lines (data visualization effect)
    const lines = [];
    for (let i = 0; i < 15; i++) {
        const points = [];
        for (let j = 0; j < 20; j++) {
            points.push(new THREE.Vector3(
                (Math.random() - 0.5) * 20,
                (Math.random() - 0.5) * 15,
                j * 0.5
            ));
        }

        const geometry = new THREE.BufferGeometry().setFromPoints(points);
        const material = new THREE.LineBasicMaterial({
            color: new THREE.Color().setHSL(Math.random(), 0.7, 0.6),
            opacity: 0.3,
            transparent: true,
            linewidth: 1
        });

        const line = new THREE.Line(geometry, material);
        line.speed = Math.random() * 0.01 + 0.005;
        scene.add(line);
        lines.push(line);
    }

    // Create toroidal knots
    const knot = new THREE.Mesh(
        new THREE.TorusKnotGeometry(2, 0.6, 100, 16),
        new THREE.MeshPhongMaterial({
            color: 0x818cf8,
            emissive: 0x6366f1,
            wireframe: true,
            opacity: 0.15,
            transparent: true
        })
    );
    knot.position.z = -5;
    scene.add(knot);

    // Lighting
    const light1 = new THREE.PointLight(0x6366f1, 1.5);
    light1.position.set(10, 10, 10);
    scene.add(light1);

    const light2 = new THREE.PointLight(0x8b5cf6, 1);
    light2.position.set(-10, -10, 10);
    scene.add(light2);

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.2);
    scene.add(ambientLight);

    // Add night sky
    const nightSky = createNightSky(scene);

    // Animation
    const clock = new THREE.Clock();
    const animate = () => {
        requestAnimationFrame(animate);
        const elapsedTime = clock.getElapsedTime();

        lines.forEach((line, index) => {
            line.position.z += line.speed;
            if (line.position.z > 15) {
                line.position.z = -15;
            }
            line.rotation.x = elapsedTime * 0.0002;
        });

        knot.rotation.x = elapsedTime * 0.1;
        knot.rotation.y = elapsedTime * 0.15;

        renderer.render(scene, camera);
    };

    animate();

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
}

// Professional UI Animations
function initUIAnimations() {
    // Smooth scroll reveal animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'slideInUp 0.6s ease-out forwards';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.content-section, .form-group, table').forEach(el => {
        observer.observe(el);
    });

    // Button ripple effect
    document.querySelectorAll('.btn-submit, .btn-action, .btnSubmit').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ripple.style.width = ripple.style.height = '20px';
            ripple.style.left = (x - 10) + 'px';
            ripple.style.top = (y - 10) + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Hover glow effect for cards
    document.querySelectorAll('.content-section, .profile-card, .login-form-wrapper').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 16px 40px rgba(99, 102, 241, 0.3)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '';
        });
    });

    // Animate numbers
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.textContent = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    document.querySelectorAll('[data-animate-number]').forEach(el => {
        const endValue = parseInt(el.getAttribute('data-animate-number'));
        observer.observe(el);
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Check which page we're on
    if (document.body.classList.contains('login-page')) {
        initThreeJsLogin();
    } else if (document.body.classList.contains('dashboard-page')) {
        initThreeJsDashboard();
    }

    // Always init UI animations
    initUIAnimations();
});
