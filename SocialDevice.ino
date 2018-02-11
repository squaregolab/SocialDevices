String msg = "  ";

//the pins we are using
int latchPin1 = 2;
int clockPin1 = 3;
int dataPin1 = 4;

int latchPin2 = 5;
int clockPin2 = 6;
int dataPin2 = 7;




int association[]={2+4+8+16+64+128,2+4,2+8+16+32+128,2+4+8+32+128,2+4+32+64,4+8+32+64+128,4+8+16+32+64+128,2+4+128,2+4+8+16+32+64+128,2+4+8+32+64+128};

void setup()
{
  //set all the pins used to talk to the chip
  //as output pins so we can write to them
  pinMode(latchPin1, OUTPUT);
  pinMode(clockPin1, OUTPUT);
  pinMode(dataPin1, OUTPUT);

  pinMode(latchPin2, OUTPUT);
  pinMode(clockPin2, OUTPUT);
  pinMode(dataPin2, OUTPUT);
  
  Serial.begin(9600);
  pinMode(13,OUTPUT);
  digitalWrite(13, LOW);
}

void afficheur1Nombre( int number)
{
  char text[5];
  sprintf(text, "%04d", number);

  int num[4];

  for(int y=0;y<=4;y++)
  {
    num[y]= text[y] - '0';
  }

  for(int i=0;i<8;i++)
  {
    digitalWrite(latchPin1, LOW);
    for(int y=3;y>=0;y--)
    {
      shiftOut(dataPin1, clockPin1, MSBFIRST, association[num[y]]);
    }
    digitalWrite(latchPin1, HIGH);
    delay(1);
  }
}

void afficheur2Nombre( int number)
{
  char text[5];
  sprintf(text, "%04d", number);

  int num[4];

  for(int y=0;y<=4;y++)
  {
    num[y]= text[y] - '0';
  }

  for(int i=0;i<8;i++)
  {
    digitalWrite(latchPin2, LOW);
    for(int y=3;y>=0;y--)
    {
      shiftOut(dataPin2, clockPin2, MSBFIRST, association[num[y]]);
    }
    digitalWrite(latchPin2, HIGH);
    delay(1);
  }
}

void loop()
{
  if (Serial.available() )
  {
    msg = Serial.readString();
    int msgLength = msg.length()+1;
    char msgChar[msgLength];
    msg.toCharArray(msgChar,msgLength);
    char nombre_char[msgLength-1];
    for(int i = 0; i < (msgLength-1); ++i)
    {
      nombre_char[i] = msgChar[i+1];
    }
    int nombre_recu = atoi(nombre_char);
    if(msgChar[0]=='f')
    {
      int like = nombre_recu;
      afficheur1Nombre(like);
    }
    else if(msgChar[0]=='t')
    {
      int tweet = nombre_recu;
      afficheur2Nombre(tweet);
    }
  }
}
