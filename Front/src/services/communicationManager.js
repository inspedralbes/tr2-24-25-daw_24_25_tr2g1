import axios from 'axios'

// Función para obtener las publicaciones
export const getPublicaciones = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/sendData')
    if (response.data.status === 'success') {
      console.log('Datos recibidos para publicaciones:', response.data.data);
      return response.data.data // Devuelve los datos de las publicaciones
    }
    console.log('publicacions rebudes')
    throw new Error('No se pudo obtener las publicaciones')
  } catch (error) {
    console.error('Error al obtener publicaciones:', error)
    return []
  }
}

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


