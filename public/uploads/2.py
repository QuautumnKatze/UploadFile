import cv2
import matplotlib.pyplot as plt
img = cv2.imread("D:/test.png")
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
negative = 255 - img
plt.subplot(221), plt.imshow(cv2.cvtColor(img, cv2.COLOR_BGR2RGB))
plt.axis('off'), plt.title('Original')
plt.subplot(222), plt.imshow(gray, cmap= 'gray')
plt.axis('off'), plt.title('gray')
plt.subplot(223), plt.imshow(cv2.cvtColor(negative, cv2.COLOR_BGR2RGB))
plt.axis('off'), plt.title('Negative')
plt.show()