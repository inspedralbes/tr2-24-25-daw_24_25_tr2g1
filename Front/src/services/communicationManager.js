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
        console.log('Dades rebudes de publicacions:', data.data)
        return data.data // Devuelve los datos de las publicaciones
      }
    }

    console.log('publicacions rebudes')
    throw new Error("No s'han pogut obtenir les publicacions")
  } catch (error) {
    console.error('Error al obtenir les publciacions', error)
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
        console.log('Dades rebudes per (id) de publicacions:', data.data)
        if (ad) return ad
      }
    }
    throw new Error("No s'han pogut obtenir els detalls de l'anunci")
  } catch (error) {
    console.error('Error al obtenir els detalls del anunci:', error)
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
    console.log('mentors rebudes')
    throw new Error("No s'han pogut obtenir els mentors")
  } catch (error) {
    console.error('Error al obtenir els mentors:', error)
    return []
  }
}
