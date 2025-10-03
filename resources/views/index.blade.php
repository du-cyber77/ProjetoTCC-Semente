@extends('layouts.app')

{{-- Botões que vão aparecer no cabeçalho --}}
@section('header-buttons')
    <div class="auth-section">
        <div class="auth-buttons" id="authButtons">
            <a href="#" class="auth-button btn-login" onclick="openModal('loginModal')">Entrar</a>
            <a href="#" class="auth-button btn-register" onclick="openModal('registerModal')">Criar Conta</a>
        </div>
        <div class="user-info" id="userInfo" style="display: none;">
            <div class="user-avatar" id="userAvatar"></div>
            <div class="user-name" id="userName"></div>
            <button class="btn-logout" onclick="logout()">Sair</button>
        </div>
    </div>
@endsection

{{-- Conteúdo principal da página --}}
@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number" id="totalTrees">1,247</span>
                    <div class="stat-label">Árvores Mapeadas</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number" id="totalSpecies">28</span>
                    <div class="stat-label">Espécies Diferentes</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number" id="favoriteTrees">89</span>
                    <div class="stat-label">Árvores Favoritas</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number" id="recentCare">156</span>
                    <div class="stat-label">Cuidados Recentes</div>
                </div>
            </div>

            <div class="controls">
                <h3>🔍 Filtros</h3>
                <div class="control-group">
                    <label for="speciesFilter">Espécie:</label>
                    <select id="speciesFilter">
                        <option value="">Todas as espécies</option>
                        <option value="pau-brasil">Pau-Brasil</option>
                        <option value="ipê-amarelo">Ipê Amarelo</option>
                        <option value="quaresmeira">Quaresmeira</option>
                        <option value="jacarandá">Jacarandá</option>
                        <option value="flamboyant">Flamboyant</option>
                        <option value="palmeira-imperial">Palmeira Imperial</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="sizeFilter">Tamanho:</label>
                    <select id="sizeFilter">
                        <option value="">Todos os tamanhos</option>
                        <option value="pequeno">Pequeno (< 5m)</option>
                        <option value="medio">Médio (5-15m)</option>
                        <option value="grande">Grande (> 15m)</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="healthFilter">Condição:</label>
                    <select id="healthFilter">
                        <option value="">Todas as condições</option>
                        <option value="excelente">Excelente</option>
                        <option value="boa">Boa</option>
                        <option value="regular">Regular</option>
                        <option value="cuidados">Precisa de Cuidados</option>
                    </select>
                </div>
            </div>

            <div class="legend">
                <h4>📍 Legenda do Mapa</h4>
                <div class="legend-item">
                    <div class="legend-color" style="background: #4CAF50;"></div>
                    <span>Condição Excelente</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #8BC34A;"></div>
                    <span>Condição Boa</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #FFC107;"></div>
                    <span>Condição Regular</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #FF5722;"></div>
                    <span>Precisa de Cuidados</span>
                </div>
            </div>

            <div class="tree-list">
                <h3>🌿 Árvores Próximas</h3>
                <div id="nearbyTrees">
                    </div>
            </div>
        </div>

        <div class="map-container">
            <div id="map"></div>
        </div>
    </div>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('loginModal')">×</span>
                <h2 class="modal-title">Bem-vindo de volta!</h2>
                <p class="modal-subtitle">Faça login para continuar explorando</p>
            </div>
            <div class="modal-body">
                <div class="success-message" id="loginSuccess"></div>
                <div class="loading" id="loginLoading">
                    <div class="spinner"></div>
                    <p>Fazendo login...</p>
                </div>
                <form id="loginForm">
                    <div class="social-login">
                        <div class="social-buttons">
                            <button type="button" class="social-btn google" onclick="socialLogin('google')">
                                <span class="social-icon">🔍</span>
                                Continuar com Google
                            </button>
                            <button type="button" class="social-btn facebook" onclick="socialLogin('facebook')">
                                <span class="social-icon">📘</span>
                                Continuar com Facebook
                            </button>
                        </div>
                        <div class="social-divider">
                            <span>ou</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="loginEmail">E-mail:</label>
                        <input type="email" id="loginEmail" name="email" required>
                        <div class="error-message">Por favor, insira um e-mail válido</div>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Senha:</label>
                        <input type="password" id="loginPassword" name="password" required>
                        <div class="error-message">A senha deve ter pelo menos 6 caracteres</div>
                        <div class="forgot-password">
                            <a onclick="switchModal('loginModal', 'forgotPasswordModal')">Esqueci minha senha</a>
                        </div>
                    </div>
                    <button type="submit" class="form-submit">Entrar</button>
                </form>
                <div class="form-switch">
                    <p>Não tem uma conta? <a onclick="switchModal('loginModal', 'registerModal')">Criar conta</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('registerModal')">×</span>
                <h2 class="modal-title">Junte-se a nós!</h2>
                <p class="modal-subtitle">Crie sua conta e faça parte da comunidade</p>
            </div>
            <div class="modal-body">
                <div class="success-message" id="registerSuccess"></div>
                <div class="loading" id="registerLoading">
                    <div class="spinner"></div>
                    <p>Criando conta...</p>
                </div>
                <form id="registerForm">
                    <div class="social-login">
                        <div class="social-buttons">
                            <button type="button" class="social-btn google" onclick="socialLogin('google')">
                                <span class="social-icon">🔍</span>
                                Criar conta com Google
                            </button>
                            <button type="button" class="social-btn facebook" onclick="socialLogin('facebook')">
                                <span class="social-icon">📘</span>
                                Criar conta com Facebook
                            </button>
                        </div>
                        <div class="social-divider">
                            <span>ou</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registerName">Nome completo:</label>
                        <input type="text" id="registerName" name="name" required>
                        <div class="error-message">Nome deve ter pelo menos 2 caracteres</div>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">E-mail:</label>
                        <input type="email" id="registerEmail" name="email" required>
                        <div class="error-message">Por favor, insira um e-mail válido</div>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Senha:</label>
                        <input type="password" id="registerPassword" name="password" required>
                        <div class="error-message">A senha deve ter pelo menos 6 caracteres</div>
                    </div>
                    <div class="form-group">
                        <label for="registerConfirmPassword">Confirmar senha:</label>
                        <input type="password" id="registerConfirmPassword" name="confirmPassword" required>
                        <div class="error-message">As senhas não coincidem</div>
                    </div>
                    <button type="submit" class="form-submit">Criar Conta</button>
                </form>
                <div class="form-switch">
                    <p>Já tem uma conta? <a onclick="switchModal('registerModal', 'loginModal')">Fazer login</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('forgotPasswordModal')">×</span>
                <h2 class="modal-title">Recuperar Senha</h2>
                <p class="modal-subtitle">Vamos ajudá-lo a recuperar sua conta</p>
            </div>
            <div class="modal-body">
                <div class="success-message" id="forgotSuccess"></div>
                <div class="loading" id="forgotLoading">
                    <div class="spinner"></div>
                    <p>Enviando código...</p>
                </div>

                <div id="forgotStep1">
                    <div class="reset-info">
                        📧 Digite seu e-mail e enviaremos um código de verificação para você redefinir sua senha.
                    </div>
                    <form id="forgotPasswordForm">
                        <div class="form-group">
                            <label for="forgotEmail">E-mail cadastrado:</label>
                            <input type="email" id="forgotEmail" name="email" required>
                            <div class="error-message">E-mail não encontrado em nosso sistema</div>
                        </div>
                        <button type="submit" class="form-submit">Enviar Código</button>
                    </form>
                </div>

                <div id="forgotStep2" style="display: none;">
                    <div class="reset-info">
                        ✉️ Enviamos um código de 6 dígitos para <strong id="emailSent"></strong>
                    </div>
                    <form id="verificationForm">
                        <div class="form-group">
                            <label>Código de verificação:</label>
                            <div class="verification-code">
                                <input type="text" class="code-input" maxlength="1" data-index="0">
                                <input type="text" class="code-input" maxlength="1" data-index="1">
                                <input type="text" class="code-input" maxlength="1" data-index="2">
                                <input type="text" class="code-input" maxlength="1" data-index="3">
                                <input type="text" class="code-input" maxlength="1" data-index="4">
                                <input type="text" class="code-input" maxlength="1" data-index="5">
                            </div>
                            <div class="error-message">Código inválido</div>
                        </div>
                        <div class="resend-code">
                            <span class="resend-timer" id="resendTimer">Reenviar código em 60s</span>
                            <a class="resend-link" id="resendLink" style="display: none;" onclick="resendCode()">Reenviar código</a>
                        </div>
                        <button type="submit" class="form-submit">Verificar Código</button>
                    </form>
                </div>

                <div id="forgotStep3" style="display: none;">
                    <div class="reset-info">
                        🔒 Agora você pode definir uma nova senha para sua conta.
                    </div>
                    <form id="newPasswordForm">
                        <div class="form-group">
                            <label for="newPassword">Nova senha:</label>
                            <input type="password" id="newPassword" name="password" required>
                            <div class="error-message">A senha deve ter pelo menos 6 caracteres</div>
                        </div>
                        <div class="form-group">
                            <label for="confirmNewPassword">Confirmar nova senha:</label>
                            <input type="password" id="confirmNewPassword" name="confirmPassword" required>
                            <div class="error-message">As senhas não coincidem</div>
                        </div>
                        <button type="submit" class="form-submit">Redefinir Senha</button>
                    </form>
                </div>

                <div class="back-to-login">
                    <a onclick="switchModal('forgotPasswordModal', 'loginModal')">← Voltar ao login</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    
    <script>
        // Coordenadas de Paracambi/RJ
        const PARACAMBI_CENTER = [-22.6063, -43.7086];
        
        // Inicializa o mapa
        var map = L.map('map').setView([-22.599753, -43.706397], 14);

        // Adiciona o tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Definir limites (caixa que envolve Paracambi)
        var bounds = [
            [-22.64, -43.76], // sudoeste (lat, lng)
            [-22.55, -43.65]  // nordeste (lat, lng)
        ];

        // Aplica os limites no mapa
        map.setMaxBounds(bounds);

        // Impede de "escapar" dos limites ao arrastar
        map.on('drag', function () {
            map.panInsideBounds(bounds, { animate: false });
        });

        // Define zoom mínimo e máximo
        map.setMinZoom(13);
        map.setMaxZoom(17);


        // Dados simulados de árvores (em um projeto real, isso viria de uma API)
        const treesData = [
            {
                id: 1,
                species: 'Pau-Brasil',
                scientificName: 'Paubrasilia echinata',
                lat: -22.6063,
                lng: -43.7086,
                height: 12,
                condition: 'excelente',
                age: 15,
                address: 'Praça Central'
            },
            {
                id: 2,
                species: 'Ipê Amarelo',
                scientificName: 'Handroanthus chrysanthus',
                lat: -22.6073,
                lng: -43.7096,
                height: 8,
                condition: 'boa',
                age: 10,
                address: 'Rua das Flores, 123'
            },
            {
                id: 3,
                species: 'Quaresmeira',
                scientificName: 'Tibouchina granulosa',
                lat: -22.6053,
                lng: -43.7076,
                height: 6,
                condition: 'regular',
                age: 8,
                address: 'Avenida Principal, 456'
            },
            {
                id: 4,
                species: 'Jacarandá',
                scientificName: 'Jacaranda mimosifolia',
                lat: -22.6083,
                lng: -43.7106,
                height: 18,
                condition: 'excelente',
                age: 25,
                address: 'Parque Municipal'
            },
            {
                id: 5,
                species: 'Flamboyant',
                scientificName: 'Delonix regia',
                lat: -22.6043,
                lng: -43.7066,
                height: 15,
                condition: 'boa',
                age: 20,
                address: 'Praça da Igreja'
            },
            {
                id: 6,
                species: 'Palmeira Imperial',
                scientificName: 'Roystonea oleracea',
                lat: -22.6093,
                lng: -43.7116,
                height: 22,
                condition: 'cuidados',
                age: 30,
                address: 'Entrada da Cidade'
            }
        ];

        // Cores baseadas na condição da árvore
        const conditionColors = {
            'excelente': '#4CAF50',
            'boa': '#8BC34A',
            'regular': '#FFC107',
            'cuidados': '#FF5722'
        };

        // Função para criar marcadores
        function createTreeMarker(tree) {
            const color = conditionColors[tree.condition];
            const size = Math.min(Math.max(tree.height * 2, 15), 30);
            
            const marker = L.circleMarker([tree.lat, tree.lng], {
                radius: size / 2,
                fillColor: color,
                color: 'white',
                weight: 2,
                opacity: 1,
                fillOpacity: 0.8
            });

            // Popup personalizado
            const popupContent = `
                <div class="custom-popup">
                    <div class="popup-header">${tree.species}</div>
                    <div class="popup-content">
                        <div class="popup-detail">
                            <span class="popup-label">Nome Científico:</span>
                            <span><em>${tree.scientificName}</em></span>
                        </div>
                        <div class="popup-detail">
                            <span class="popup-label">Altura:</span>
                            <span>${tree.height}m</span>
                        </div>
                        <div class="popup-detail">
                            <span class="popup-label">Idade:</span>
                            <span>${tree.age} anos</span>
                        </div>
                        <div class="popup-detail">
                            <span class="popup-label">Condição:</span>
                            <span style="color: ${color}; font-weight: bold;">${tree.condition.charAt(0).toUpperCase() + tree.condition.slice(1)}</span>
                        </div>
                        <div class="popup-detail">
                            <span class="popup-label">Localização:</span>
                            <span>${tree.address}</span>
                        </div>
                    </div>
                </div>
            `;

            marker.bindPopup(popupContent, {
                maxWidth: 300,
                className: 'custom-popup-container'
            });

            return marker;
        }

        // Adicionar marcadores ao mapa
        let treeMarkers = [];
        treesData.forEach(tree => {
            const marker = createTreeMarker(tree);
            marker.addTo(map);
            treeMarkers.push(marker);
        });

        // Função para filtrar árvores
        function filterTrees() {
            const speciesFilter = document.getElementById('speciesFilter').value;
            const sizeFilter = document.getElementById('sizeFilter').value;
            const healthFilter = document.getElementById('healthFilter').value;

            treeMarkers.forEach((marker, index) => {
                const tree = treesData[index];
                let show = true;

                if (speciesFilter && tree.species.toLowerCase().includes(speciesFilter) === false) {
                    show = false;
                }

                if (sizeFilter) {
                    if (sizeFilter === 'pequeno' && tree.height >= 5) show = false;
                    if (sizeFilter === 'medio' && (tree.height < 5 || tree.height > 15)) show = false;
                    if (sizeFilter === 'grande' && tree.height <= 15) show = false;
                }

                if (healthFilter && tree.condition !== healthFilter) {
                    show = false;
                }

                if (show) {
                    map.addLayer(marker);
                } else {
                    map.removeLayer(marker);
                }
            });

            updateNearbyTreesList();
        }

        // Adicionar event listeners aos filtros
        document.getElementById('speciesFilter').addEventListener('change', filterTrees);
        document.getElementById('sizeFilter').addEventListener('change', filterTrees);
        document.getElementById('healthFilter').addEventListener('change', filterTrees);

        // Função para atualizar lista de árvores próximas
        function updateNearbyTreesList() {
            const nearbyTreesDiv = document.getElementById('nearbyTrees');
            nearbyTreesDiv.innerHTML = '';

            // Mostrar as primeiras 5 árvores como exemplo
            treesData.slice(0, 5).forEach(tree => {
                const treeItem = document.createElement('div');
                treeItem.className = 'tree-item';
                treeItem.innerHTML = `
                    <div class="tree-species">${tree.species}</div>
                    <div class="tree-details">
                        ${tree.address} • ${tree.height}m • ${tree.condition}
                    </div>
                `;
                
                treeItem.addEventListener('click', () => {
                    map.setView([tree.lat, tree.lng], 18);
                    // Encontrar e abrir o popup correspondente
                    treeMarkers[treesData.indexOf(tree)].openPopup();
                });
                
                nearbyTreesDiv.appendChild(treeItem);
            });
        }

        // Inicializar lista de árvores próximas
        updateNearbyTreesList();

        // Adicionar controle de escala
        L.control.scale({
            metric: true,
            imperial: false,
            position: 'bottomright'
        }).addTo(map);

        // Efeito de hover nos marcadores
        treeMarkers.forEach(marker => {
            marker.on('mouseover', function(e) {
                this.setStyle({
                    weight: 3,
                    fillOpacity: 1
                });
            });
            
            marker.on('mouseout', function(e) {
                this.setStyle({
                    weight: 2,
                    fillOpacity: 0.8
                });
            });
        });

        // Atualizar estatísticas dinamicamente
        function updateStats() {
            const visibleTrees = treeMarkers.filter(marker => map.hasLayer(marker));
            document.getElementById('totalTrees').textContent = visibleTrees.length.toLocaleString();
            
            // Simular outras estatísticas
            document.getElementById('totalSpecies').textContent = Math.min(28, Math.ceil(visibleTrees.length / 5));
            document.getElementById('favoriteTrees').textContent = Math.ceil(visibleTrees.length * 0.07);
            document.getElementById('recentCare').textContent = Math.ceil(visibleTrees.length * 0.12);
        }

        // Event listener para mudanças no mapa
        map.on('zoomend moveend', updateStats);
        
        // Inicializar estatísticas
        updateStats();

        // Sistema de Autenticação
        let currentUser = null;

        // Dados simulados de usuários (em um projeto real, isso viria do backend)
        const users = [];

        // Função para abrir modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Função para fechar modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
            
            // Limpar formulários
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
                clearFormErrors(form);
            }
        }

        // Função para alternar entre modais
        function switchModal(fromModalId, toModalId) {
            closeModal(fromModalId);
            setTimeout(() => openModal(toModalId), 300);
        }

        // Fechar modal ao clicar fora dele
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal(event.target.id);
            }
        });

        // Função para validar email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Função para limpar erros do formulário
        function clearFormErrors(form) {
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.classList.remove('error');
            });
        }

        // Função para mostrar erro em campo específico
        function showFieldError(field) {
            field.classList.add('error');
        }

        // Função para validar formulário de registro
        function validateRegisterForm(formData) {
            let isValid = true;
            const form = document.getElementById('registerForm');
            clearFormErrors(form);

            // Validar nome
            if (formData.name.length < 2) {
                showFieldError(document.getElementById('registerName'));
                isValid = false;
            }

            // Validar email
            if (!isValidEmail(formData.email)) {
                showFieldError(document.getElementById('registerEmail'));
                isValid = false;
            }

            // Validar senha
            if (formData.password.length < 6) {
                showFieldError(document.getElementById('registerPassword'));
                isValid = false;
            }

            // Validar confirmação de senha
            if (formData.password !== formData.confirmPassword) {
                showFieldError(document.getElementById('registerConfirmPassword'));
                isValid = false;
            }

            // Verificar se email já existe
            if (users.find(user => user.email === formData.email)) {
                showFieldError(document.getElementById('registerEmail'));
                isValid = false;
            }

            return isValid;
        }

        // Função para validar formulário de login
        function validateLoginForm(formData) {
            let isValid = true;
            const form = document.getElementById('loginForm');
            clearFormErrors(form);

            // Validar email
            if (!isValidEmail(formData.email)) {
                showFieldError(document.getElementById('loginEmail'));
                isValid = false;
            }

            // Validar senha
            if (formData.password.length < 6) {
                showFieldError(document.getElementById('loginPassword'));
                isValid = false;
            }

            return isValid;
        }

        // Função para simular delay de requisição
        function simulateApiDelay(ms = 1500) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        // Função para registrar usuário
        async function registerUser(userData) {
            const loadingDiv = document.getElementById('registerLoading');
            const form = document.getElementById('registerForm');
            const successDiv = document.getElementById('registerSuccess');
            
            loadingDiv.style.display = 'block';
            form.style.display = 'none';

            try {
                // Simular requisição ao servidor
                await simulateApiDelay();

                // Adicionar usuário ao array (simulação do banco de dados)
                const newUser = {
                    id: users.length + 1,
                    name: userData.name,
                    email: userData.email,
                    password: userData.password, // Em produção, seria hasheada
                    createdAt: new Date().toISOString()
                };
                
                users.push(newUser);

                // Mostrar mensagem de sucesso
                successDiv.innerHTML = `
                    <h3>🎉 Conta criada com sucesso!</h3>
                    <p>Bem-vindo(a), ${userData.name}! Você será redirecionado para o login.</p>
                `;
                successDiv.style.display = 'block';
                loadingDiv.style.display = 'none';

                // Redirecionar para login após 2 segundos
                setTimeout(() => {
                    switchModal('registerModal', 'loginModal');
                    successDiv.style.display = 'none';
                    form.style.display = 'block';
                }, 2000);

            } catch (error) {
                loadingDiv.style.display = 'none';
                form.style.display = 'block';
                alert('Erro ao criar conta. Tente novamente.');
            }
        }

        // Função para fazer login
        async function loginUser(credentials) {
            const loadingDiv = document.getElementById('loginLoading');
            const form = document.getElementById('loginForm');
            const successDiv = document.getElementById('loginSuccess');
            
            loadingDiv.style.display = 'block';
            form.style.display = 'none';

            try {
                // Simular requisição ao servidor
                await simulateApiDelay();

                // Verificar credenciais
                const user = users.find(u => 
                    u.email === credentials.email && u.password === credentials.password
                );

                if (user) {
                    // Login bem-sucedido
                    currentUser = user;
                    
                    successDiv.innerHTML = `
                        <h3>✅ Login realizado com sucesso!</h3>
                        <p>Bem-vindo de volta, ${user.name}!</p>
                    `;
                    successDiv.style.display = 'block';
                    loadingDiv.style.display = 'none';

                    // Atualizar interface
                    setTimeout(() => {
                        updateAuthInterface();
                        closeModal('loginModal');
                        successDiv.style.display = 'none';
                        form.style.display = 'block';
                    }, 2000);

                } else {
                    // Credenciais inválidas
                    loadingDiv.style.display = 'none';
                    form.style.display = 'block';
                    showFieldError(document.getElementById('loginEmail'));
                    showFieldError(document.getElementById('loginPassword'));
                    alert('E-mail ou senha incorretos.');
                }

            } catch (error) {
                loadingDiv.style.display = 'none';
                form.style.display = 'block';
                alert('Erro ao fazer login. Tente novamente.');
            }
        }

        // Função para atualizar interface após login/logout
        function updateAuthInterface() {
            const authButtons = document.getElementById('authButtons');
            const userInfo = document.getElementById('userInfo');
            const userName = document.getElementById('userName');
            const userAvatar = document.getElementById('userAvatar');

            if (currentUser) {
                // Usuário logado
                authButtons.style.display = 'none';
                userInfo.style.display = 'flex';
                userName.textContent = currentUser.name;
                userAvatar.textContent = currentUser.name.charAt(0).toUpperCase();
            } else {
                // Usuário deslogado
                authButtons.style.display = 'flex';
                userInfo.style.display = 'none';
            }
        }

        // Função para fazer logout
        function logout() {
            currentUser = null;
            updateAuthInterface();
        }

        // Event listeners para os formulários
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('registerName').value.trim(),
                email: document.getElementById('registerEmail').value.trim(),
                password: document.getElementById('registerPassword').value,
                confirmPassword: document.getElementById('registerConfirmPassword').value
            };

            if (validateRegisterForm(formData)) {
                registerUser(formData);
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                email: document.getElementById('loginEmail').value.trim(),
                password: document.getElementById('loginPassword').value
            };

            if (validateLoginForm(formData)) {
                loginUser(formData);
            }
        });

        // Verificar se há usuário logado ao carregar a página (simulação de sessão)
        function checkUserSession() {
            // Em um projeto real, verificaria o token no localStorage ou cookie
            const savedUser = localStorage.getItem('currentUser');
            if (savedUser) {
                currentUser = JSON.parse(savedUser);
                updateAuthInterface();
            }
        }

        // Salvar sessão do usuário (simulação)
        function saveUserSession() {
            if (currentUser) {
                localStorage.setItem('currentUser', JSON.stringify(currentUser));
            } else {
                localStorage.removeItem('currentUser');
            }
        }

        // Atualizar salvamento de sessão
        const originalUpdateAuthInterface = updateAuthInterface;
        updateAuthInterface = function() {
            originalUpdateAuthInterface();
            saveUserSession();
        };

        // Verificar sessão ao carregar
        checkUserSession();

        // Sistema de Login Social
        async function socialLogin(provider) {
            const loadingDiv = provider === 'google' ? 
                document.getElementById('loginLoading') : document.getElementById('registerLoading');
            const form = provider === 'google' ? 
                document.getElementById('loginForm') : document.getElementById('registerForm');
            
            loadingDiv.style.display = 'block';
            form.style.display = 'none';

            try {
                // Simular autenticação social
                await simulateApiDelay(2000);

                // Simular dados retornados pela rede social
                const socialUserData = {
                    google: {
                        name: 'João Silva',
                        email: 'joao.silva@gmail.com',
                        avatar: 'https://lh3.googleusercontent.com/a/default-user',
                        provider: 'google'
                    },
                    facebook: {
                        name: 'Maria Santos',
                        email: 'maria.santos@facebook.com',
                        avatar: 'https://graph.facebook.com/me/picture',
                        provider: 'facebook'
                    }
                };

                const userData = socialUserData[provider];
                
                // Verificar se já existe usuário com este e-mail
                let user = users.find(u => u.email === userData.email);
                
                if (!user) {
                    // Criar novo usuário
                    user = {
                        id: users.length + 1,
                        name: userData.name,
                        email: userData.email,
                        provider: userData.provider,
                        avatar: userData.avatar,
                        createdAt: new Date().toISOString()
                    };
                    users.push(user);
                }

                // Fazer login
                currentUser = user;
                
                const successDiv = document.querySelector('.modal.show .success-message');
                successDiv.innerHTML = `
                    <h3>✅ Login com ${provider} realizado!</h3>
                    <p>Bem-vindo(a), ${user.name}!</p>
                `;
                successDiv.style.display = 'block';
                loadingDiv.style.display = 'none';

                setTimeout(() => {
                    updateAuthInterface();
                    closeModal(document.querySelector('.modal.show').id);
                    successDiv.style.display = 'none';
                    form.style.display = 'block';
                }, 2000);

            } catch (error) {
                loadingDiv.style.display = 'none';
                form.style.display = 'block';
                alert(`Erro ao fazer login com ${provider}. Tente novamente.`);
            }
        }

        // Sistema de Recuperação de Senha
        let resetEmail = '';
        let verificationCode = '';
        let resendTimer = null;

        // Função para gerar código aleatório
        function generateVerificationCode() {
            return Math.floor(100000 + Math.random() * 900000).toString();
        }

        // Enviar código de recuperação
        async function sendResetCode(email) {
            const loadingDiv = document.getElementById('forgotLoading');
            const step1 = document.getElementById('forgotStep1');
            const successDiv = document.getElementById('forgotSuccess');
            
            loadingDiv.style.display = 'block';
            step1.style.display = 'none';

            try {
                await simulateApiDelay();

                // Verificar se e-mail existe
                const user = users.find(u => u.email === email);
                if (!user) {
                    throw new Error('E-mail não encontrado');
                }

                resetEmail = email;
                verificationCode = generateVerificationCode();
                
                console.log(`Código de verificação enviado para ${email}: ${verificationCode}`);

                successDiv.innerHTML = `
                    <h3>📧 Código enviado!</h3>
                    <p>Verificamos que você está tentando recuperar a senha. Para fins de demonstração, o código é: <strong>${verificationCode}</strong></p>
                `;
                successDiv.style.display = 'block';
                loadingDiv.style.display = 'none';

                // Ir para próxima etapa
                setTimeout(() => {
                    goToForgotStep(2);
                    successDiv.style.display = 'none';
                }, 3000);

            } catch (error) {
                loadingDiv.style.display = 'none';
                step1.style.display = 'block';
                showFieldError(document.getElementById('forgotEmail'));
            }
        }

        // Navegar entre etapas do reset
        function goToForgotStep(step) {
            // Esconder todas as etapas
            document.getElementById('forgotStep1').style.display = 'none';
            document.getElementById('forgotStep2').style.display = 'none';
            document.getElementById('forgotStep3').style.display = 'none';
            
            // Mostrar etapa atual
            document.getElementById(`forgotStep${step}`).style.display = 'block';
            
            if (step === 2) {
                document.getElementById('emailSent').textContent = resetEmail;
                startResendTimer();
            }
        }

        // Timer para reenviar código
        function startResendTimer() {
            let seconds = 60;
            const timerElement = document.getElementById('resendTimer');
            const resendLink = document.getElementById('resendLink');
            
            timerElement.style.display = 'inline';
            resendLink.style.display = 'none';
            
            if (resendTimer) clearInterval(resendTimer);
            
            resendTimer = setInterval(() => {
                seconds--;
                timerElement.textContent = `Reenviar código em ${seconds}s`;
                
                if (seconds <= 0) {
                    clearInterval(resendTimer);
                    timerElement.style.display = 'none';
                    resendLink.style.display = 'inline';
                }
            }, 1000);
        }

        // Reenviar código
        function resendCode() {
            verificationCode = generateVerificationCode();
            console.log(`Novo código enviado: ${verificationCode}`);
            
            const successDiv = document.getElementById('forgotSuccess');
            successDiv.innerHTML = `
                <h3>📧 Novo código enviado!</h3>
                <p>Código: <strong>${verificationCode}</strong></p>
            `;
            successDiv.style.display = 'block';
            
            setTimeout(() => {
                successDiv.style.display = 'none';
            }, 3000);
            
            startResendTimer();
        }

        // Configurar inputs do código de verificação
        function setupCodeInputs() {
            const inputs = document.querySelectorAll('.code-input');
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value;
                    
                    if (value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    
                    // Auto-verificar quando todos os campos estão preenchidos
                    if (index === inputs.length - 1 && value.length === 1) {
                        setTimeout(() => {
                            const code = Array.from(inputs).map(input => input.value).join('');
                            if (code.length === 6) {
                                verifyCode(code);
                            }
                        }, 100);
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        }

        // Verificar código
        async function verifyCode(code) {
            const loadingDiv = document.getElementById('forgotLoading');
            const step2 = document.getElementById('forgotStep2');
            
            loadingDiv.style.display = 'block';
            step2.style.display = 'none';

            try {
                await simulateApiDelay(1000);

                if (code === verificationCode) {
                    loadingDiv.style.display = 'none';
                    goToForgotStep(3);
                } else {
                    throw new Error('Código inválido');
                }

            } catch (error) {
                loadingDiv.style.display = 'none';
                step2.style.display = 'block';
                
                // Mostrar erro nos inputs
                const inputs = document.querySelectorAll('.code-input');
                inputs.forEach(input => {
                    input.classList.add('error');
                    input.value = '';
                });
                
                inputs[0].focus();
            }
        }

        // Redefinir senha
        async function resetPassword(newPassword) {
            const loadingDiv = document.getElementById('forgotLoading');
            const step3 = document.getElementById('forgotStep3');
            const successDiv = document.getElementById('forgotSuccess');
            
            loadingDiv.style.display = 'block';
            step3.style.display = 'none';

            try {
                await simulateApiDelay();

                // Atualizar senha do usuário
                const user = users.find(u => u.email === resetEmail);
                if (user) {
                    user.password = newPassword;
                }

                successDiv.innerHTML = `
                    <h3>🎉 Senha redefinida!</h3>
                    <p>Sua nova senha foi salva com sucesso. Você pode fazer login agora.</p>
                `;
                successDiv.style.display = 'block';
                loadingDiv.style.display = 'none';

                setTimeout(() => {
                    switchModal('forgotPasswordModal', 'loginModal');
                    successDiv.style.display = 'none';
                    goToForgotStep(1); // Reset para primeira etapa
                }, 2500);

            } catch (error) {
                loadingDiv.style.display = 'none';
                step3.style.display = 'block';
                alert('Erro ao redefinir senha. Tente novamente.');
            }
        }

        // Event listeners para formulários de recuperação
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('forgotEmail').value.trim();
            if (isValidEmail(email)) {
                sendResetCode(email);
            } else {
                showFieldError(document.getElementById('forgotEmail'));
            }
        });

        document.getElementById('verificationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const inputs = document.querySelectorAll('.code-input');
            const code = Array.from(inputs).map(input => input.value).join('');
            if (code.length === 6) {
                verifyCode(code);
            }
        });

        document.getElementById('newPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmNewPassword').value;
            
            let isValid = true;
            
            if (newPassword.length < 6) {
                showFieldError(document.getElementById('newPassword'));
                isValid = false;
            }
            
            if (newPassword !== confirmPassword) {
                showFieldError(document.getElementById('confirmNewPassword'));
                isValid = false;
            }
            
            if (isValid) {
                resetPassword(newPassword);
            }
        });

        // Configurar inputs do código quando a página carregar
        setupCodeInputs();
    </script>
@endsection

