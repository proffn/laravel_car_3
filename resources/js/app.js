// Загружаем jQuery и делаем его глобальным
const $ = require('jquery');
window.$ = window.jQuery = $;

// Загружаем Bootstrap
const bootstrap = require('bootstrap');
window.bootstrap = bootstrap;

// Импортируем SASS стили
require('../sass/app.scss');

// Остальной код остается БЕЗ ИЗМЕНЕНИЙ
document.addEventListener('DOMContentLoaded', () => {
    // Toast уведомление
    const loadBtn = document.querySelector('#loadBtn');
    const toastEl = document.querySelector('#myToast');
    
    if (loadBtn && toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
            delay: 4000,
        });

        loadBtn.addEventListener('click', () => {
            toast.show();
        });
    }

    // Модальное окно с переключением
    const cards = Array.from(document.querySelectorAll('.car-card'));
    const modalElement = document.getElementById('infoModal');
    const modalDescription = document.getElementById('modalDescription');
    const modalTitle = document.getElementById('infoModalLabel');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (modalElement && modalDescription && modalTitle) {
        const modal = new bootstrap.Modal(modalElement);

        // Данные для модальных окон
        const carDetails = {
            camry1: {
                title: 'Toyota Camry 2018',
                description: `Toyota Camry 2018 года в отличном состоянии. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Пробег"
                        data-bs-trigger="hover focus"
                        data-bs-content="Пробег 85 000 км, в основном по трассе. Регулярное обслуживание у официального дилера.">
                        Пробег 85 000 км
                    </span>
                    , автомобиль обслуживался у официального дилера. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="История обслуживания"
                        data-bs-trigger="hover focus"
                        data-bs-content="Полная сервисная история: 2020 - замена масла, 2022 - тормозные колодки, 2023 - аккумулятор">
                        Полная сервисная история
                    </span>
                    . Безаварийная история, один владелец.`
            },
            focus1: {
                title: 'Ford Focus 2017', 
                description: `Ford Focus 2017 года, универсал. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Пробег"
                        data-bs-trigger="hover focus"
                        data-bs-content="Пробег 120 000 км, преимущественно городской цикл. Двигатель в отличном состоянии.">
                        Пробег 120 000 км
                    </span>
                    . Автомобиль прошел все плановые ТО. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Техническое состояние"
                        data-bs-trigger="hover focus"
                        data-bs-content="В 2023 году заменено сцепление, тормозные диски и колодки. Кондиционер работает исправно.">
                        Отличное техническое состояние
                    </span>
                    . Не битый, не крашенный.`
            },
            civic1: {
                title: 'Honda Civic 2019',
                description: `Honda Civic 2019 года, хэтчбек. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Пробег"
                        data-bs-trigger="hover focus"
                        data-bs-content="Всего 45 000 км пробега. Автомобиль использовался аккуратно, в основном для поездок по городу.">
                        Всего 45 000 км
                    </span>
                    . Экономичный и надежный автомобиль. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Особенности"
                        data-bs-trigger="hover focus"
                        data-bs-content="Комплектация Executive: кожаный салон, подогрев сидений, камера заднего вида, датчики парковки.">
                        Полная комплектация
                    </span>
                    . Идеальное состояние.`
            },
            x3: {
                title: 'BMW X3 2020',
                description: `BMW X3 2020 года, внедорожник премиум-класса. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Пробег"
                        data-bs-trigger="hover focus"
                        data-bs-content="Всего 35 000 км. Автомобиль приобретен новым, обслуживается у официального дилера BMW.">
                        Минимальный пробег 35 000 км
                    </span>
                    . Полный привод, автоматическая коробка передач. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Оснащение"
                        data-bs-trigger="hover focus"
                        data-bs-content="Комплектация M Sport: спортивный пакет, панорамная крыша, адаптивный круиз-контроль, система помощи при парковке.">
                        Максимальная комплектация
                    </span>
                    . Гаражное хранение.`
            },
            golf: {
                title: 'Volkswagen Golf 2016',
                description: `Volkswagen Golf 2016 года, хэтчбек. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Пробег"
                        data-bs-trigger="hover focus"
                        data-bs-content="Пробег 95 000 км. Автомобиль обслуживался строго по регламенту, все работы документированы.">
                        Пробег 95 000 км
                    </span>
                    . Надежный немецкий автомобиль. 
                    <span class="text-primary fw-semibold" data-bs-toggle="popover" title="Обслуживание"
                        data-bs-trigger="hover focus"
                        data-bs-content="Регулярное ТО: 2018 - 30 000 км, 2020 - тормозные диски 60 000 км, 2022 - свечи зажигания.">
                        Вся история обслуживания
                    </span>
                    . Отличное состояние для своего возраста.`
            }
        };

        const carOrder = ['camry1', 'focus1', 'civic1', 'x3', 'golf'];
        let currentCarIndex = 0;

        // Обработчики для кнопок-стрелок
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Previous button clicked');
                currentCarIndex = (currentCarIndex - 1 + carOrder.length) % carOrder.length;
                showCarInfo(carOrder[currentCarIndex]);
            });
            
            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Next button clicked');
                currentCarIndex = (currentCarIndex + 1) % carOrder.length;
                showCarInfo(carOrder[currentCarIndex]);
            });
        }

        // Обработчики кликов по карточкам
        cards.forEach((card) => {
            card.addEventListener('click', () => {
                const carKey = card.dataset.car;
                currentCarIndex = carOrder.indexOf(carKey);
                console.log('Card clicked:', carKey, 'Index:', currentCarIndex);
                showCarInfo(carKey);
            });
        });

        function showCarInfo(carKey) {
            const car = carDetails[carKey];
            if (car) {
                modalTitle.textContent = car.title;
                modalDescription.innerHTML = car.description;
                
                console.log('Showing car info:', carKey);
                
                // Показываем модальное окно
                modal.show();
                
                // Даем фокус модальному окну
                setTimeout(() => {
                    modalElement.focus();
                    console.log('Modal focused');
                }, 300);

                // popover внутри модалки
                setTimeout(() => {
                    const popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
                    console.log('Popovers found:', popovers.length);
                    popovers.forEach(el => {
                        try {
                            new bootstrap.Popover(el);
                            console.log('Popover initialized');
                        } catch (error) {
                            console.error('Popover error:', error);
                        }
                    });
                }, 400);
            }
        }

        // Обработчик для клавиш 
        document.addEventListener('keydown', (e) => {
            console.log('Key pressed:', e.key);
            
            // Проверяем, что модальное окно открыто
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (!modalInstance || !modalInstance._isShown) return;

            if (e.key === 'ArrowRight') {
                console.log('Next car - global handler');
                currentCarIndex = (currentCarIndex + 1) % carOrder.length;
                showCarInfo(carOrder[currentCarIndex]);
                e.preventDefault();
            }

            if (e.key === 'ArrowLeft') {
                console.log('Previous car - global handler');
                currentCarIndex = (currentCarIndex - 1 + carOrder.length) % carOrder.length;
                showCarInfo(carOrder[currentCarIndex]);
                e.preventDefault();
            }
        });
    } else {
        console.error('Modal elements not found');
    }
});