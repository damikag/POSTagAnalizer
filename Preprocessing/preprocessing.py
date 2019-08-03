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

    def calcPercentage(self):
        lst=[]

        for tag in sorted(self.tag_dic.keys()):
            self.percetage[tag]=float(len(self.tag_dic[tag]))/self.wordCount*100
            lst.append([tag,self.percetage[tag]])
        
        return lst

    def printTags(self):
        for tag in sorted(self.tag_dic.keys()):
            print tag

    def writeWordToFile(self,outputfile):
        for tag in sorted(self.tag_dic.keys()):
            for ln in self.tag_dic[tag]:
                if self.word=='\\':
                    outputfile.write('\\\\ '+tag+' '+str(ln[0])+' '+ln[1]+'\n')
                else:
                    outputfile.write(self.word+' '+tag+' '+str(ln[0])+' '+ln[1]+'\n')

    def writeWordTags(self,outputfile):
        lst=self.tag_dic.keys()
        cnts=[]
        for tag in lst:
            cnts.append(str(self.wordTag_count[tag]))

        if self.word=='\\':
            write_line='\\\\ '+str(','.join(lst)+' '+str(','.join(cnts)))
        else:
            write_line=self.word+' '+str(','.join(lst)+' '+str(','.join(cnts)))
        

        outputfile.write(write_line+'\n')
            




def WriteProcessedCorpus(Word_dictionary,outputfile_name):
    outputfile=open(outputfile_name,"w")

    for word in sorted(Word_dictionary.keys()):
        if Word_dictionary[word].noOfTags() >1:
            Word_dictionary[word].writeWordToFile(outputfile)
    
    outputfile.close()

def WriteProcessedUniquwWords(Word_dictionary,outputfile_name):
    outputfile=open(outputfile_name,"w")

    for word in sorted(Word_dictionary.keys()):
    
        if Word_dictionary[word].noOfTags() >1:
            Word_dictionary[word].writeWordTags(outputfile)

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
        
        if len(line.strip().split())>=4:
             
            word,tag,ln=line.strip().split()[:3]
            file_name=''.join(line.strip().split()[3:])
           
            if word in Word_dictionary:
                Word_dictionary[word].addPair(tag,ln,file_name)
            else:
                Word_dictionary[word]= Word(word)
                Word_dictionary[word].addPair(tag,ln,file_name)
        else:
            junk_lines.append([line_number,line])

# print "Finished reading"
# print("--- %s seconds ---" % (time.time() - start_time))

start_time=time.time()

WriteProcessedCorpus(Word_dictionary,save_to+"newCorpus.txt")

# print "Finished writing"
# print("--- %s seconds ---" % (time.time() - start_time))


start_time=time.time()

WriteProcessedUniquwWords(Word_dictionary,save_to+"uniqueWords.txt")

# print "Finished writing"
# print("--- %s seconds ---" % (time.time() - start_time))

if len(junk_lines):
    print "Some junk lines found.\nWriting to newJunk.txt"

    junkFile=open("newJunk.txt","w")

    for line in junk_lines:
        junkFile.write(str(line[0])+line[1])

    print "Finished writing to newJunk.txt"

print "ok"