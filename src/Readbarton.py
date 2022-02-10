#!/usr/bin/env python3
# -*- coding: utf8 -*-
#
#    Copyright 2018 Daniel Perron
#
#    Base on Mario Gomez <mario.gomez@teubi.co>   MFRC522-Python
#
#    This file use part of MFRC522-Python
#    MFRC522-Python is a simple Python implementation for
#    the MFRC522 NFC Card Reader for the Raspberry Pi.
#
#    MFRC522-Python is free software:
#    you can redistribute it and/or modify
#    it under the terms of
#    the GNU Lesser General Public License as published by the
#    Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    MFRC522-Python is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Lesser General Public License for more details.
#
#    You should have received a copy of the
#    GNU Lesser General Public License along with MFRC522-Python.
#    If not, see <http://www.gnu.org/licenses/>.
#
import time
import RPi.GPIO as GPIO
import MFRC522
import signal
import mysql.connector
from mysql.connector import Error

continue_reading = True


# function to read uid an conver it to a string

def uidToString(uid):
    mystring = ""
    for i in uid:
        mystring = format(i, '02X') + mystring
    return mystring


# Capture SIGINT for cleanup when the script is aborted
def end_read(signal, frame):
    global continue_reading
    print("Ctrl+C captured, ending read.")
    continue_reading = False
    GPIO.cleanup()

# Hook the SIGINT
signal.signal(signal.SIGINT, end_read)

# Create an object of the class MFRC522
MIFAREReader = MFRC522.MFRC522()

# Welcome message
#print("Welcome to the MFRC522 data read example")
#print("Press Ctrl-C to stop.")

timeout_start = time.time()

# This loop keeps checking for chips.
# If one is near it will get the UID and authenticate
while continue_reading:

    # Scan for cards
    (status, TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)

    # If a card is found
    if status == MIFAREReader.MI_OK:
 #       print ("Card detected")

        # Get the UID of the card
        (status, uid) = MIFAREReader.MFRC522_SelectTagSN()
        # If we have the UID, continue
        if status == MIFAREReader.MI_OK:

            try:
                connection = mysql.connector.connect(host='localhost',
                                         database='cardsdb',
                                         user='dave',
                                         password='squash')
                if connection.is_connected():
                    # If no result is returned, un-rem the next line to check connection
  #                  print("Connection to database established")
                    cursor = connection.cursor()

                    # The next line is replaced by the one after
                    # fob_number = '273A0097'
                    fob_number = uidToString(uid)

                    args = [fob_number, 0]
                    result_args = cursor.callproc('fob_holder', args)
                    continue_reading = False

                    # (result_args[1]) contains the returned name from the database
                    print(result_args[1])
                    # Sleep to prevent blocking the cpu
                    time.sleep(1)

            except Error as e:
                print("Error while connecting to MySQL", e)

            finally:
                if (connection.is_connected()):
                    cursor.close()
                    connection.close()
            
#            print("Card read UID: %s" % uidToString(uid))

        else:
            print("Authentication error")

        if time.time() > timeout_start + 10:
            print('TIMEOUT')
            continue_reading = False


