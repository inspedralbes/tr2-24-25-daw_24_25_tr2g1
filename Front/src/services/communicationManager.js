import axios from 'axios'

// Función para obtener las publicaciones
export const getPublicaciones = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/sendData')
    if (response.data.status === 'success') {
      return response.data.data // Devuelve los datos de las publicaciones
    }
    console.log('publicacions rebudes')
    throw new Error('No se pudo obtener las publicaciones')
  } catch (error) {
    console.error('Error al obtener publicaciones:', error)
    return []
  }
}

// Función para crear una publicación
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
    return data;
  } catch (error) {
    console.error('Error al enviar la oferta:', error)
  }
}

// Función para obtener los mentores
export const getMentors = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/sendDataMentors')
    if (response.data.status === 'success') {
      return response.data.data // Devuelve los datos de las publicaciones
    }
    console.log('publicacions rebudes')
    throw new Error('No se pudo obtener los mentores')
  } catch (error) {
    console.error('Error al obtener mentores:', error)
    return []
  }
}

// Función para obtener los detalles de una publicación
export const getAdDetails = async (id) => {
  try {
    const response = await axios.post('http://localhost:8000/api/sendData')
    if (response.data.status === 'success') {
      const ad = response.data.data.find((ad) => ad.id === parseInt(id))
      if (ad) return ad
    }
    throw new Error('No se pudo obtener los detalles')
  } catch (error) {
    console.error('Error al obtener detalles de la publicación:', error)
    return {}
  }
}
