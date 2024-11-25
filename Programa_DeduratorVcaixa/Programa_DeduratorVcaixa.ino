/*
  Projeto: Dedurator SPF
  Descrição: Sistema de controle de botões e LEDs com música em um ESP32 WROOM.

░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
█▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀█
█░██░██░██░██░██░██░██░██░██░░░░░░░░░░█
█░██░██░██░██░██░██░██░██░██░░░░░░░░░░█
█▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄█
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
░░█░░░░█▀▀▀█░█▀▀█░█▀▀▄░▀█▀░█▄░░█░█▀▀█░░
░░█░░░░█░░░█░█▄▄█░█░░█░░█░░█░█░█░█░▄▄░░
░░█▄▄█░█▄▄▄█░█░░█░█▄▄▀░▄█▄░█░░▀█░█▄▄█░░
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
*/

#include <Arduino.h>

// as portas que da pra utilizar tem o numero: 36, 39, 34, 35, 32, 33, 25, 26, 27, 14, 12, 13, 23, 22, 1, 3, 21, 19, 18, 5, 17, 16, 4, 2, 15. Use somente essas portas

// Definições dos pinos
const int pinosBotoes[] = {2, 4, 5, 12, 13, 14, 15, 16, 17, 18}; // Pinos dos botões
const int pinosLedsPisca[] = {19, 21, 22}; // Pinos dos LEDs piscantes (RGB: 3 cores)
const int pinosLedsAcoes[] = {25, 26, 27, 32, 33, 34, 35, 36, 23, 1}; // Pinos dos LEDs para cada botão
const int pinoBuzzer = 39; // Pino do buzzer
const int pinoLedMemoria = 3; // Pino do LED de memória (acende durante a contagem)

// Cores correspondentes aos botões
const char* cores[] = {"Vermelho", "Verde", "Azul", "Amarelo", "Laranja", "Rosa", "Roxo", "Azul Bebê", "Verde Abacate", "Branco"};

// Frequências das músicas inspiradas em Zelda
const int melodia1[] = {659, 659, 523, 659, 784, 392}; // Música 1
const int melodiaInicial[] = {784, 880, 988, 1047, 1175, 1319, 1480, 1568}; // Música de inicialização mais longa

// Frequências da música inspirada no tema do Minecraft
const int melodiaMinecraft[] = {392, 392, 440, 392, 349, 329}; // Música inspirada no tema do Minecraft

const int duracaoNota = 500; // Duração das notas

// Variáveis para verificação de botão
const int PINO_BOTAO = 21; // Pino GPIO21 conectado ao botão
int ultimoEstado = HIGH; // Estado anterior do pino de entrada
int estadoAtual;     // Leitura atual do pino de entrada

void setup() {
  Serial.begin(115200);

  // Inicializa os pinos dos botões como entrada com pullup interno
  for (int i = 0; i < 10; i++) {
    pinMode(pinosBotoes[i], INPUT_PULLUP);
  }

  // Inicializa os pinos dos LEDs como saída
  for (int i = 0; i < 4; i++) {
    pinMode(pinosLedsPisca[i], OUTPUT);
  }

  for (int i = 0; i < 10; i++) {
    pinMode(pinosLedsAcoes[i], OUTPUT);
  }

  pinMode(pinoBuzzer, OUTPUT);
  pinMode(pinoLedMemoria, OUTPUT);

  // Inicializa o pino do botão como entrada com pull-up interno
  pinMode(PINO_BOTAO, INPUT_PULLUP);

  // Toca a música de inicialização mais longa
  tocarMelodia(melodiaInicial, sizeof(melodiaInicial) / sizeof(int));
}

void loop() {
  Serial.println("Início do loop"); // Indica o início do loop

  // Lê o estado atual do botão
  estadoAtual = digitalRead(PINO_BOTAO);

  // Verifica se houve uma transição de estado no botão
  if (ultimoEstado == LOW && estadoAtual == HIGH) {
    // Encontra qual botão foi pressionado
    int botaoPressionado = verificarBotaoPressionado();

    if (botaoPressionado != -1) {
      Serial.print("Botão ");
      Serial.print(botaoPressionado);
      Serial.print(" pressionado - Cor: ");
      Serial.print(cores[botaoPressionado]);
      Serial.print(" - LED: ");
      Serial.println(pinosLedsAcoes[botaoPressionado]);

      // Liga o LED correspondente ao botão pressionado
      digitalWrite(pinosLedsAcoes[botaoPressionado], HIGH);

      // Liga os LEDs piscantes
      for (int i = 0; i < 4; i++) {
        digitalWrite(pinosLedsPisca[i], HIGH);
      }

      // Liga o LED de memória
      digitalWrite(pinoLedMemoria, HIGH);

      // Toca a música inspirada no tema do Minecraft
      tocarMelodia(melodiaMinecraft, sizeof(melodiaMinecraft) / sizeof(int));

      // Contagem de 10 segundos e impressão no monitor serial
      for (int i = 1; i <= 10; i++) {
        Serial.print("Segundo: ");
        Serial.println(i);
        digitalWrite(pinoLedMemoria, !digitalRead(pinoLedMemoria)); // Pisca o LED de memória
        delay(1000); // Espera 1 segundo
      }

      // Desliga o LED correspondente ao botão pressionado
      digitalWrite(pinosLedsAcoes[botaoPressionado], LOW);

      // Desliga os LEDs piscantes e o LED de memória
      for (int i = 0; i < 4; i++) {
        digitalWrite(pinosLedsPisca[i], LOW);
      }
      digitalWrite(pinoLedMemoria, LOW);
    }
  }

  // Atualiza o estado anterior do botão
  ultimoEstado = estadoAtual;

  // Piscar LEDs quando nenhum botão está pressionado
  piscarLeds();

  Serial.println("Fim do loop"); // Indica o fim do loop
}

// Função para verificar qual botão foi pressionado
int verificarBotaoPressionado() {
  for (int i = 0; i < 10; i++) {
    if (digitalRead(pinosBotoes[i]) == LOW) {
      return i;
    }
  }
  return -1;
}

// Função para piscar os LEDs
void piscarLeds() {
  static unsigned long ultimaHoraPisca = 0;
  static bool estadoLed = LOW;

  if (millis() - ultimaHoraPisca > 500) {
    ultimaHoraPisca = millis();
    estadoLed = !estadoLed;
    for (int i = 0; i < 4; i++) {
      digitalWrite(pinosLedsPisca[i], estadoLed);
    }
  }
}

// Função para tocar uma melodia
void tocarMelodia(const int *melodia, int tamanho) {
  for (int i = 0; i < tamanho; i++) {
    tone(pinoBuzzer, melodia[i], duracaoNota);
    delay(duracaoNota * 1.30);
    noTone(pinoBuzzer);
  }
}

// Copyright (c) 2024, Vinicius Kum
