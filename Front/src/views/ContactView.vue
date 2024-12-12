<template>
  <form class="form">
    <div class="title">Contacta amb nosaltres</div>
    <input type="text" placeholder="El teu correu" class="input">
    <textarea placeholder="Missatge"></textarea>
    
    <div class="contacts">
      <p>Dades de contacte:</p>
      <p>Correu: lorem@ipsum</p>
      <p>Telèfon: 123456789</p>
    </div>
    <button>Enviar</button>
  </form>
</template>
  
<script>
</script>

  <style>
.form {
  position: relative;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  gap: 10px;
  width: 100%;
  background-color: rgb(223, 223, 223);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 30px 30px -30px rgba(27, 26, 26, 0.315);
}

.form .title {
  color: #0095ff;
  font-size: 30px;
  font-weight: 600;
  letter-spacing: -1px;
  line-height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.form input {
  outline: 0;
  border: 1px solid rgb(219, 213, 213);
  padding: 8px 14px;
  border-radius: 8px;
  width: 100%;
  height: 50px;
}

.form textarea {
  border-radius: 8px;
  height: 100px;
  width: 100%;
  resize: none;
  outline: 0;
  padding: 8px 14px;
  border: 1px solid rgb(219, 213, 213);
}

.form button {
  align-self: flex-end;
  padding: 8px;
  outline: 0;
  border: 0;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 500;
  background-color: #0095ff;
  color: #fff;
  cursor: pointer;
}

.contacts {
  display: flex;
  gap: 10px;
}
    
</style>
  