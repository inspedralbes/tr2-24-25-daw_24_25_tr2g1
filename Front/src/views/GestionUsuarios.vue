<template>
  <div v-if="showPopup" class="popup-overlay">
    <div class="popup-content">
      <div class="popup-header">
        <h2>Gestió d'Usuaris</h2>
        <button @click="togglePopup" class="close-button">&times;</button>
      </div>

      <div v-if="loading" class="loading">Carregant...</div>
      <div v-else-if="error" class="error">{{ error }}</div>

      <div v-else class="users-container">
        <div class="filters">
          <input type="text" placeholder="Cercar usuaris..." class="search-input" />
        </div>

        <div class="users-list">
          <div v-for="user in users" :key="user.id" class="user-item">
            <div class="user-info">
              <img :src="user.foto_profile || '/src/assets/icons/user.svg'" alt="Perfil" class="user-avatar" />
              <div class="user-details">
                <span class="user-name">{{ user.nom }} {{ user.cognom1 }}</span>
                <span class="user-email">{{ user.correu }}</span>
              </div>
            </div>
            <select :value="user.rol" @change="handleRoleChange(user.id, $event.target.value)" class="role-select">
              <option value="alumne">Alumne</option>
              <option value="mentor">Mentor</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { getAllUsers, updateUserRole } from '@/services/communicationManager.js';

const users = ref([]);
const showPopup = ref(false);
const loading = ref(false);
const error = ref(null);

const fetchUsers = async () => {
  try {
    loading.value = true;
    const data = await getAllUsers();
    users.value = data.filter(user => user.rol === 'alumne' || user.rol === 'mentor');
  } catch (error) {
    error.value = 'Error al cargar els usuaris';
    console.log(error);
  } finally {
    loading.value = false;
  }
};

const handleRoleChange = async (userId, newRole) => {
  try {
    await updateUserRole(userId, newRole);
    await fetchUsers();
  } catch (error) {
    error.value = 'Error al actualitzar el rol';
    console.log(error);
  }
};

const togglePopup = () => {
  showPopup.value = !showPopup.value;
  if (showPopup.value) {
    fetchUsers();
  }
};

defineExpose({ togglePopup });

</script>


<style scoped>
.popup-overlay {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-content {
  background-color: #fff;
  border-radius: 6px;
  width: 95%;
  max-width: 600px;
  max-height: 85vh;
  overflow-y: auto;
  padding: 16px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ddd;
  padding-bottom: 8px;
  margin-bottom: 16px;
}

.popup-header h2 {
  font-size: 1.2rem;
  color: #333;
  margin: 0;
}

.close-button {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #666;
}

.loading, .error {
  text-align: center;
  font-size: 1rem;
  color: #555;
  margin: 20px 0;
}

.filters {
  margin-bottom: 12px;
}

.search-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

.users-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.user-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px;
  border: 1px solid #eee;
  border-radius: 6px;
  background-color: #fafafa;
}

.user-item:hover {
  background-color: #f1f1f1;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

.user-details {
  display: flex;
  flex-direction: column;
}

.user-name {
  font-size: 0.95rem;
  font-weight: 500;
  color: #333;
}

.user-email {
  font-size: 0.85rem;
  color: #555;
}

.role-select {
  padding: 6px 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #fff;
  font-size: 0.9rem;
  color: #333;
  cursor: pointer;
}

.role-select:hover {
  border-color: #aaa;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .popup-content {
    width: 90%;
    padding: 12px;
  }

  .popup-header h2 {
    font-size: 1rem;
  }

  .user-avatar {
    width: 35px;
    height: 35px;
  }

  .user-item {
    padding: 10px;
  }

  .role-select {
    font-size: 0.85rem;
  }
}

</style>
