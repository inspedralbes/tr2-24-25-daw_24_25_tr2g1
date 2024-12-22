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
    const response = await fetch('http://localhost:8000/api/sendData', {
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
    const response = await fetch('http://localhost:8000/api/sendDataMentors', {
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
    const response = await fetch(`http://localhost:8000/api/sendData`, {
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
