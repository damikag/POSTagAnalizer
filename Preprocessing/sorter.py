#!/usr/bin/env python
import time
import sys

class Word:
    def __init__(self,word):
        self.tag_dic={}
        self.word=word
        self.percetage={}
        self.wordCount=0
        self.wordTag_count={}

    def addPair(self,tag,line_number,file_name):
        self.wordCount+=1
        if tag in self.tag_dic:
            self.tag_dic[tag].append([line_number,file_name])
        else:
            self.tag_dic[tag]=[[line_number,file_name]]
            self.wordTag_count[tag]=0
        self.wordTag_count[tag]+=1

    def noOfTags(self):
        return len(self.tag_dic.keys())

   

    def writeWordToFile(self,outputfile):
        for tag in sorted(self.tag_dic.keys()):
            for ln in self.tag_dic[tag]:
                if self.word=='\\':
                    outputfile.write('\\\\ '+tag+' '+str(ln[0])+' '+ln[1]+'\n')
                else:
                    outputfile.write(self.word+' '+tag+' '+str(ln[0])+' '+ln[1]+'\n')

def WriteProcessedCorpus(Word_dictionary,outputfile_name):
    outputfile=open(outputfile_name,"w")

    for word in sorted(Word_dictionary.keys()):
        Word_dictionary[word].writeWordToFile(outputfile)
    
    outputfile.close()

# ==========================================================================

start_time = time.time()
try:
    input_file=str(sys.argv[1])
    save_to=""

    if len(sys.argv)>=3:
        save_to=str(sys.argv[2])
except:
    print "Command line argument error"
    sys.exit()


Word_dictionary={}
junk_lines=[]
# print "Reading........"

with open(input_file) as file: 
    line_number=0 

    for line in file:

        line_number+=1
        
        if len(line.strip().split())==4:
             
            word,tag,ln,file_name=line.strip().split()
           
            if word in Word_dictionary:
                Word_dictionary[word].addPair(tag,ln,file_name)
            else:
                Word_dictionary[word]= Word(word)
                Word_dictionary[word].addPair(tag,ln,file_name)
        else:
            junk_lines.append([line_number,line])

WriteProcessedCorpus(Word_dictionary,save_to+"SortedCorpus.txt")

print "ok"