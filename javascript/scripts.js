let evenements = [{
    "title": "MS Pas de biblio",
    "start": "2023-03-27 09:20:00",
    "end": "2023-03-27 10:20:00",
    "backgroundColor": "#FF0000"
},{
    "title": "CE1 B Martine Journeau \n Sylvie Palmer",
    "start": "2023-03-27 10:30:00",
    "end": "2023-03-27 11:30:00",
    "backgroundColor": "#6600FF"
 },{
    "title": "CP B Amèle Elmaliki \n Ségolène Portela",
    "start": "2023-03-27 13:30:00",
    "end": "2023-03-27 14:30:00",
    "backgroundColor": "#66FF66"
 },{
    "title": "MS/GS Charlene Maillard \n  Fabien Dartis",
    "start": "2023-03-27 14:30:00",
    "end": "2023-03-27 15:30:00",
    "backgroundColor": "#000000"
 },{
    "title": "CE2 B et C Charlene Maillard \n Martine Journeau",
    "start": "2023-03-27 15:30:00",
    "end": "2023-03-27 16:30:00",
    "backgroundColor": "#FF0000"
 },{
    "title": "PS Nina Prévotaux \n Evelyne Maboundou",
    "start": "2023-03-28 09:15:00",
    "end": "2023-03-28 10:00:00",
    "backgroundColor": "#66FF66"
 },{
    "title": " CE2 A Elodie Offredy \n Martine Journeau",
    "start": "2023-03-28 10:30:00",
    "end": "2023-03-28 11:30:00",
    "backgroundColor": "#FF0000"
 },{
    "title": "CE1 C Thierry Gamain",
    "start": "2023-03-28 13:30:00",
    "end": "2023-03-28 14:15:00",
    "backgroundColor": "#6600FF"
 },{
    "title": "CP C Sylvie Palmer \n Martine Journeau",
    "start": "2023-03-28 15:30:00",
    "end": "2023-03-28 16:30:00",
    "backgroundColor": "#FF0000"
 },{
    "title": "CM2 ABC Pascale Benabdessalem",
    "start": "2023-03-30 12:00:00",
    "end": "2023-03-30 13:20:00",
    "backgroundColor": "#6600FF"
 },{
    "title": "CM1 C Pascale Benabdessalem \n Thierry Gamain",
    "start": "2023-03-30 13:30:00",
    "end": "2023-03-30 14:30:00",
    "backgroundColor": "#FF0000"
 },{
    "title": "CM1 A Charlène Maillard \n Alexandra Serrecchia",
    "start": "2023-03-30 15:10:00",
    "end": "2023-03-30 15:30:00",
    "backgroundColor": "#000000"
 },{
    "title": "CM1 B Elodie Offredy \n Martine Journeau",
    "start": "2023-03-30 15:30:00",
    "end": "2023-03-30 16:30:00",
    "backgroundColor": "#66FF66"
 },
 {
    "title": "GS Vanessa Atger \n Marie Saussier",
    "start": "2023-03-31 09:15:00",
    "end": "2023-03-31 10:15:00",
    "backgroundColor": "#FF0000"
 },{
    "title": "CE1 A Emilie Legrand",
    "start": "2023-03-31 13:30:00",
    "end": "2023-03-31 14:30:00",
    "backgroundColor": "#6600FF"
    
 },{
    "title": "CP A Jean-Pierre Favre \n Alexandra Serrecchia",
    "start": "2023-03-31 15:30:00",
    "end": "2023-03-30 16:30:00",
    "backgroundColor": "#66FF66"
    
 }
 
 
 



]
 
window.onload = () => {
    
    let elementCalendrier = document.getElementById("calendrier")
    
    
    
                // On instancie le calendrier
                let calendrier = new FullCalendar.Calendar(elementCalendrier, {
                    
                    
                    // On appelle les composants
                    plugins: ['dayGrid','timeGrid','list','slotMinTime'],
                    
                    defaultView: 'timeGridWeek',
                    slotMinTime: "08:00:00",
                   slotMaxTime: "18:00:00",
                    locale: 'fr',
                    hiddenDays: [ 3 ],
                    
                   
                    // scrollTime: "08:00:00",
                    weekends: false,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,list'
                    },
                    buttonText: {
                        today: 'Aujourd\'hui',
                        month: 'Mois',
                        week: 'Semaine',
                        list: 'Liste'
                    },
                    
                   
                   events: evenements,
                   
                    
                   
                   
                

                


            })
            
            
           calendrier.render()
            
        }
     

    

