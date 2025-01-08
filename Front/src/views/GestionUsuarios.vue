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
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-content {
  background-color: white;
  border-radius: 8px;
  width: 90%;
  max-width: 800px;
  max-height: 80vh;
  overflow-y: auto;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}

.close-button {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #666;
}

.loading {
  text-align: center;
  padding: 20px;
  color: #666;
}

.error {
  color: #dc3545;
  text-align: center;
  padding: 20px;
}

.filters {
  margin-bottom: 20px;
}

.search-input {
  width: 100%;
  padding: 8px 12px;
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
  border-radius: 4px;
  transition: background-color 0.2s;
}

.user-item:hover {
  background-color: #f8f9fa;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
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
  font-weight: 500;
}

.user-email {
  font-size: 0.9em;
  color: #666;
}

.role-select {
  padding: 6px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: white;
  cursor: pointer;
}

.role-select:hover {
  border-color: #999;
}
</style>
