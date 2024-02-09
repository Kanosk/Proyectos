#esto esta hecho para jugar con Isiris y con Akramelserio by Kanosk (aunque lo puede usar cualquiera que quiera)
from turtle import textinput
from kivy.app import App
from kivy.uix.gridlayout import GridLayout
from kivy.uix.label import Label
from kivy.uix.image import Image
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput
from kivy.core.window import Window
import random

juegos = ["Wow-retail", "Wow-classic", "Lol", "Heroes of the Storm", "Overwatch", "Rainbow 6 Siege", "Otro" ]

class Xus4me(App):
    def build(self):
        self.window = GridLayout()
        self.window.cols = 1
        self.window.size_hint = (0.6, 0.7)
        self.window.pos_hint = {"center_x": 0.5, "center_y": 0.5}
                
        #(imagen que se ve como logo
        self.window.add_widget(Image(source="xus4melogo.png"))
        
        #texto principal que cambia con el boton principal
        self.greeting = Label(text="¿A que jugamos ahora?", font_size = 18, color='#17BEBB')
        self.window.add_widget(self.greeting)
               
        #boton principal para el listado de juegos arriba
        self.button = Button(text="Elige", size_hint = (1, 0.5), bold = True, background_color='#17BEBB',)
        self.button.bind(on_press=self.callback1)
        self.window.add_widget(self.button)
        
        #para Otros, se diferencia por el 1 en self.greeting
        self.greeting1 = Label(text="¿Te ha salido Otro?", font_size = 18, color='#17BEBB')
        self.window.add_widget(self.greeting1)
        self.greeting2 = Label(text="Pon las iniciales y la que salga elige juego", font_size = 18, color='#17BEBB')
        self.window.add_widget(self.greeting2)
                
        #esto es para añadir el texto por parte del usuario, para añadir mas juegos a otros
        self.user = TextInput(multiline=False, padding = (15,5),  size_hint = (1, 0.5))        
        self.window.add_widget(self.user)     
        
        #boton secundario para los metidos en el input
        self.button = Button(text="Elige de los otros", size_hint = (1, 0.5), bold = True, background_color='#17BEBB')
        self.button.bind(on_press=self.callback2)
        self.window.add_widget(self.button)
               
        return self.window
      
        #esto es para que muestre un mensaje cuando le hayan dado al boton para elegir uno de la lista preconfigurada
    def callback1(self, instance):
        self.greeting.text = "¡Hoy juegas a " + random.choice(juegos) + "!"
       
        
    def callback2(self, instance):
        self.greeting1.text = random.choice(self.user.text.split())
        
         

if __name__ == "__main__":
    Xus4me().run()
    
        
        