// Función para obtener las publicaciones
export const getPublicaciones = async () => {
  try {
    const response = await fetch('http://localhost:8000/api/sendData', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    if (response.ok) {
      const data = await response.json();
      if (data.status === 'success') {
        console.log('Datos recibidos para publicaciones:', data.data);
        return data.data; // Devuelve los datos de las publicaciones
      }
    }

    console.log('publicacions rebudes');
    throw new Error('No se pudo obtener las publicaciones');
  } catch (error) {
    console.error('Error al obtener publicaciones:', error);
    return [];
  }
};

export const getMentors = async () => {
  try{
    const response = await fetch('http://localhost:8000/api/sendDataMentors', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    if (response.ok) {
      const data = await response.json();
      if (data.status === 'success') {
        console.log('Datos recibidos para mentors:', data.data);
        return data.data;
      }
    }
    console.log('mentors rebudes');
    throw new Error('No se pudo obtener los mentors');
  }catch(error){
    console.error('Error al obtener mentors:', error);
    return [];
  }
}

export const getAdDetails = async (id)=>{
  try {
    const response = await fetch(`http://localhost:8000/api/sendData`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    if (response.ok) {
      const data = await response.json();
      if (data.status === 'success') {
        const ad = data.data.find((ad) => ad.id === parseInt(id));
        console.log('datos recibidos para publicaciones:', data.data);
        if (ad) return ad;
      }
    }
    throw new Error('No se pudo obtener los detalles del anuncio');
  }catch(error){
    console.error('Error al obtener detalles del anuncio:', error);
    return [];
  }
};

