export async function createPublicacion(oferta) {
  // Envia els dades a la API
  try {
    // console.log(oferta) per comprovar les dades que rebem des de l'usuari
    const resposta = await fetch('http://127.0.0.1:8000/api/createOffer', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(oferta),
    })

    if (!resposta.ok) throw new Error(data.message || 'Error de connexió')

    const data = await resposta.json()
    return data
  } catch (error) {
    console.error('Error al enviar la pulicació de la oferta de la classe:', error)
  }
}

// Función para obtener las publicaciones
export const getPublicaciones = async () => {
  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/sendData', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (response.ok) {
      const data = await response.json()
      if (data.status === 'success') {
        console.log('Dades rebudes per a les publicacions:', data.data)
        return data.data // Devuelve los datos de las publicaciones
      }
    }

    console.log('Publicacions Rebudes')
    throw new Error('No es poden o btenir les publicacions')
  } catch (error) {
    console.error('Error al obtener publicaciones:', error)
    return []
  }
}

export const getMentors = async () => {
  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/sendDataMentors', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    if (response.ok) {
      const data = await response.json()
      if (data.status === 'success') {
        console.log('Dades rebudes dels mentors:', data.data)
        return data.data
      }
    }
    console.log('Mentors rebuts')
    throw new Error('No es poden obtenir els mentors')
  } catch (error) {
    console.error('Error al obtenir mentors:', error)
    return []
  }
}

export const getAdDetails = async (id) => {
  try {
    const response = await fetch(`http://alumnet.daw.inspedralbes.cat/laravel/public/api/sendData`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    if (response.ok) {
      const data = await response.json()
      if (data.status === 'success') {
        const ad = data.data.find((ad) => ad.id === parseInt(id))
        console.log('datos recibidos para publicaciones:', data.data)
        if (ad) return ad
      }
    }
    throw new Error('No es poden obtenir els detalls de la oferta')
  } catch (error) {
    console.error('Error al obtenir els detalls dels anuncis:', error)
    return []
  }
}

export const registerForClass = async (classId, studentId, mentorId) => {
  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/register-class', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        classId: classId,
        studentId: studentId,
        mentorId: mentorId,
      }),
    })

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error(errorData.message || 'No es poden registrar a la classe')
    }

    const data = await response.json()
    return data
  } catch (error) {
    console.error('Error al registrar a la classe:', error)
    throw error
  }
}

// Fetch para obtener todos los alumnos y mentores para cambiar el rol desde la cuenta de profe

export const getAllUsers = async () => {
  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/sendDataUsers', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (response.ok) {
      const data = await response.json()
      if (data.status === 'success') {
        return data.data
      }
    }
    throw new Error('No es poden obtenir els usuaris')
  } catch (error) {
    console.error('Error al obtenir usuaris:', error)
    return []
  }
}

export const updateUserRole = async (userId, newRole) => {
  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/rols/assign', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        user_id: userId,
        rol: newRole,
      }),
    })

    if (!response.ok) {
      throw new Error('Error al actualitzar el rol')
    }

    return await response.json()
  } catch (error) {
    console.error('Error:', error)
    throw error
  }
}

// Fetch para cambiar la contraseña
export const passwordService = {
  async enviarCodigoRecuperacion(email) {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/password/send-reset-code', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ correualternatiu: email }),
    })

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error('Error al enviar el código')
    }

    return await response.json()
  },

  async verificarCodigo(email, code) {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/password/verify-code', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ correualternatiu: email, code }),
    })

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error('Codigo incorrecto')
    }
    return await response.json()
  },
  async restablecerContraseña(email, password, code) {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/password/reset', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        correualternatiu: email,
        password: password,
        code: code
      }),
    })

    if (!response.ok) {
      const errorData = await response.json();
      throw new Error(errorData.error || 'Error al restablecer la contraseña');
    }

    return await response.json();
  }

}
