import time
import serial

from urllib2 import urlopen
import bs4 as BeautifulSoup

import json
from collections import OrderedDict
from json.decoder import WHITESPACE
from twython import TwythonStreamer, Twython, TwythonError

from sys import stdout, stdin
from select import poll, POLLIN

import os
import sys
reload(sys)
sys.setdefaultencoding('utf8')

#incremente le compteur de tweets sur l'afficheur à segments
def increment_tweet():
	try:
		with open("Counter.txt", "r") as fichier:
			contenu = fichier.read()
    		fichier.close()
		nombre = int(float(contenu[:-1]))+1
		if nombre > 9999:
			nombre = 0
		with open("Counter.txt", "w") as fichier:
			fichier.write(str(nombre)+"t")
		fichier.close()
		ser.write('t'+str(nombre))
	except:
		with open("Counter.txt", "w") as fichier:
			fichier.write("1t")
		fichier.close()
		ser.write("1t")
	time.sleep(2)

#La fonction va lire le nombre de like sur la page choisit par l'utilisateur
def lire_like():
	with open("Facebook.txt", "r") as fichier:
		contenu = fichier.read()
    	fichier.close()
	
	html = urlopen('https://www.facebook.com/'contenu+'/').read()
	soup = BeautifulSoup.BeautifulSoup(html, "html.parser")

	letters = soup.findAll('div', {"class":"_2pi9 _2pi2"})[0].div.text

	i=0
	nb_like=""
	while letters[i]!=' ':
		nb_like=nb_like+letters[i]
		i=i+1
	ser.write('f'+str(nb_like))
	print(str(nb_like))

#Fonction convertissant les .json générer ecrire_json() par  en .xml
def ecrire_xml():
	with open("fichier.json", "r") as fichier:
		old = json.load(fichier)
	fichier.close()
	i = len(old)-1
	y = 1
	text="texte"
	mon_fichier = open("data_posts.xml", "w")
	mon_fichier.write("<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>\n")
	mon_fichier.write("<donnees>\n")
	while i >= 0:
		mon_fichier.write("<post id=\"post-")
		text = str(y) +"\" value=\""
		y += 1
		mon_fichier.write(text)
		mon_fichier.write(old[i]["platform"])
		mon_fichier.write("\">\n")
		mon_fichier.write("<pic_avatar>")
		mon_fichier.write(old[i]["url_avatar"])
		mon_fichier.write("</pic_avatar>\n")
		mon_fichier.write("<user_name>")
		mon_fichier.write(old[i]["user_name"])
		mon_fichier.write("</user_name>\n")
		mon_fichier.write("<text>")
		mon_fichier.write(old[i]["text"])
		mon_fichier.write("</text>\n")
		if old[i]["media"] != 0:
			mon_fichier.write("<pic_media>")
			mon_fichier.write(old[i]["media"])
			mon_fichier.write("</pic_media>\n")
		mon_fichier.write("<created_at>")
		mon_fichier.write(old[i]["created_at"])
		mon_fichier.write("</created_at>\n</post>\n")
		i -= 1
	mon_fichier.write("</donnees>")
	fichier.close()

#Lis le filtre choisit par l'utilisateur
def chargement_hashtag():
	with open("Filter.txt", "r") as fichier:
		TERMS = fichier.read()
	fichier.close()
	return TERMS

#Créer une speudo base de données en .json
def ecrire_json(user_name_recu, url_avatar_recu, text_recu, media_recu,created_at_recu, platform_recu):
	class Post:

		def __init__(self,user_name,user_screen_name,text,created_at,platform):
			self.user_name=user_name
			self.text=text
			self.created_at=created_at
			self.platform=platform

	new = OrderedDict()

	new["user_name"] = user_name_recu
	new["url_avatar"] = url_avatar_recu
	new["text"] = text_recu
	new["media"] = media_recu
	new["created_at"] = created_at_recu
	new["platform"] = platform_recu


	liste_posts = []

	old = []

	try:
		with open("fichier.json", "r") as fichier:
			old = json.load(fichier)
			liste_posts.extend(old)
			if len(liste_posts) > 19:
				del liste_posts[0]
	#Si le .json n'existe, un nouveau est créé
	except:
		with open("fichier.json", 'w') as fichier:
			json.dump(new, fichier, indent=4)


	fichier.close()
	liste_posts.append(new)

	with open("fichier.json", 'w') as fichier:
		json.dump(liste_posts, fichier, indent=4)

	fichier.close()
	ecrire_xml()

#Remplacez **** par vos clé
APP_KEY = '****'
APP_SECRET = '****'
OAUTH_TOKEN = '****'
OAUTH_TOKEN_SECRET = '****'

#Définition de l'addresse de l'arduino
ser = serial.Serial('/dev/ttyACM0', 9600)
#attente afin de ne laisser le temps à l'Arduino d'être fonctionnelle avec son port série 
time.sleep(2)

class MyStreamer(TwythonStreamer):
	def on_success(self, data):
		if 'text' in data:
			print('lecture d un tweet')
			user_name_recu = data['user']['name']
			url_avatar_recu = data['user']['profile_image_url']
			text_recu = data['text'].encode('utf-8')
			created_at_recu = data['created_at']
			created_at_recu=created_at_recu[:20]+created_at_recu[26]+created_at_recu[27]+created_at_recu[28]+created_at_recu[29]
			platform_recu = 'twitter'
			#vérification de la présence une image ou une video joint au tweet
			if 'media' in data['entities'].keys():
				media = data['entities']['media']
				for mediaitem in media:
					if 'media_url' in mediaitem.keys():
						media_recu = mediaitem['media_url']
			else:
				media_recu = 0
			ecrire_json(user_name_recu, url_avatar_recu, text_recu, media_recu,created_at_recu, platform_recu)
			increment_tweet()
	def on_error(self, status_code, data):
		try:
			lire_like()
		except:
			print('error facebook')
                stream.statuses.filter(track=chargement_hashtag())
try:
	stream = MyStreamer(APP_KEY, APP_SECRET,OAUTH_TOKEN, OAUTH_TOKEN_SECRET)
	stream.statuses.filter(track=chargement_hashtag())
except:
	print 'error'
