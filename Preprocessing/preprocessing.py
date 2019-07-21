import time
import sys

class Word:
    def __init__(self,word):
        self.tag_dic={}
        self.word=word
        self.percetage={}
        self.wordCount=0
        self.wordTag_count={}

    def addPair(self,tag,line_number):
        self.wordCount+=1
        if tag in self.tag_dic:
            self.tag_dic[tag].append(line_number)
        else:
            self.tag_dic[tag]=[line_number]
            self.wordTag_count[tag]=0
        self.wordTag_count[tag]+=1

    def writeToFile(self):
        for tag in self.tag_dic.keys():
       
            Outfile=open('ans/AA'+str(hash(self.word))+tag+'.txt','w')
            for item in self.tag_dic[tag]:
                # print item
                Outfile.write(str(item))
                Outfile.write('\n')
            Outfile.close()

    def noOfTags(self):
        return len(self.tag_dic.keys())

    def calcPercentage(self):
        lst=[]

        for tag in self.tag_dic.keys():
            self.percetage[tag]=float(len(self.tag_dic[tag]))/self.wordCount*100
            lst.append([tag,self.percetage[tag]])
        
        return lst

    def printTags(self):
        for tag in self.tag_dic.keys():
            print tag

    def printLineNumbers(self,tag):
        cnt=0
        if tag in self.tag_dic.keys():
            for ln in self.tag_dic[tag]:
                print ln
                if cnt==10:return
                cnt+=1
        else:
            print 'Tag not found'    

    def writeWordToFile(self,outputfile):
        for tag in self.tag_dic.keys():
            for ln in self.tag_dic[tag]:
                if self.word=='\\':
                    outputfile.write('\\\\ '+tag+' '+str(ln)+'\n')
                else:
                    outputfile.write(self.word+' '+tag+' '+str(ln)+'\n')

    def writeWordTags(self,outputfile):
        lst=self.tag_dic.keys()
        cnts=[]
        for tag in lst:
            cnts.append(str(self.wordTag_count[tag]))

        write_line=self.word+' '+str(','.join(lst)+' '+str(','.join(cnts)))
        outputfile.write(write_line+'\n')
            




def WriteProcessedCorpus(Word_dictionary,outputfile_name):
    outputfile=open(outputfile_name,"w")

    for word in Word_dictionary.keys():
        if Word_dictionary[word].noOfTags() >1:
            Word_dictionary[word].writeWordToFile(outputfile)
    
    outputfile.close()

def WriteProcessedUniquwWords(Word_dictionary,outputfile_name):
    outputfile=open(outputfile_name,"w")

    for word in Word_dictionary.keys():
    
        if Word_dictionary[word].noOfTags() >1:
            Word_dictionary[word].writeWordTags(outputfile)

    outputfile.close()

# ==========================================================================

start_time = time.time()

try:
    input_file=str(sys.argv[1])
    working_dir=""

    if len(sys.argv)>=3:
        working_dir=str(sys.argv[2])
except:
    print "Command line argument error"
    sys.exit()


Word_dictionary={}
junk_lines=[]
print "Reading........"

with open(working_dir+input_file) as file: 
    line_number=0 

    for line in file:

        line_number+=1
        
        if len(line.strip().split())==2:
             
            word,tag=line.strip().split()
           
            if word in Word_dictionary:
                Word_dictionary[word].addPair(tag,line_number)
            else:
                Word_dictionary[word]= Word(word)
                Word_dictionary[word].addPair(tag,line_number)
        else:
            junk_lines.append([line_number,line])

print "Finished reading"
print("--- %s seconds ---" % (time.time() - start_time))

start_time=time.time()

WriteProcessedCorpus(Word_dictionary,working_dir+"newCorpus.txt")

print "Finished writing"
print("--- %s seconds ---" % (time.time() - start_time))


start_time=time.time()

WriteProcessedUniquwWords(Word_dictionary,working_dir+"uniqueWords.txt")

print "Finished writing"
print("--- %s seconds ---" % (time.time() - start_time))

if len(junk_lines):
    print "Some junk lines found.\nWriting to newJunk.txt"

    junkFile=open("newJunk.txt","w")

    for line in junk_lines:
        junkFile.write(str(line[0])+line[1])

    print "Finished writing to newJunk.txt"